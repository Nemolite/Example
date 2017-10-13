<?php


class DBclass 
{

  var $server   = ""; //database server
  var $user     = ""; //database login name
  var $pass     = ""; //database login password
  var $database = ""; //database name
  var $pre      = ""; //table prefix, optional

  
  var $error = "";
  var $errno = 0;
  
  
  var $affected_rows = 0;
  
  var $link_id = 0; 
  var $query_id = 0; 
  
  
  // constructor
  public function __construct($server, $user, $pass, $database, $pre='')
  {
  	$this->server=$server;
  	$this->user=$user;
  	$this->pass=$pass;              
  	$this->database=$database;
  	$this->pre=$pre;
  }
  
  
  public function connect($new_link=false) 
	  { 
		$this->link_id=@mysql_connect($this->server,$this->user,$this->pass,$new_link);

		if (!$this->link_id) {
			$this->oops("Could not connect to server: <b>$this->server</b>.");
			} 
	  
		if(!@mysql_select_db($this->database, $this->link_id)) {//no database
			$this->error("Could not open database: <b>$this->database</b>.");
			} 
		mysql_query ("set character_set_server='utf8'");  	
		mysql_query ("set character_set_client='utf8'");  
		mysql_query ("set character_set_results='utf8'");  
		mysql_query ("set collation_connection='utf8_general_ci'"); 
	  				
		$this->server='';
		$this->user='';
		$this->pass='';
		$this->database='';
	  }


  // close the connection
  public function close() 
	  {
		if(!@mysql_close($this->link_id)){
			$this->error("Connection close failed.");
		}
	  }
  
  // escapes characters to be mysql ready
  
  public function escape($string) 
	  { 
		if(get_magic_quotes_runtime()) $string = stripslashes($string);
		return mysql_real_escape_string($string);
	  }


    // executes SQL query to an open connection
  
  public function query($sql) 
	  {
			$this->query_id = @mysql_query($sql, $this->link_id);
			if (!$this->query_id) { 
			$this->error("<b>MySQL Query fail:</b> $sql");
			return 0;
		}
		
		$this->affected_rows = @mysql_affected_rows($this->link_id); 
	  
		return $this->query_id; 
	  }
  
  // fetches and returns results one line at a time
  
  public function fetch_array($query_id=-1)
	  {
		// retrieve row
		if ($query_id!=-1) {
			$this->query_id=$query_id;
		}
	  
		if (isset($this->query_id)) {
			$record = @mysql_fetch_assoc($this->query_id);
			   
		}else{ 
			$this->error("Invalid query_id: <b>$this->query_id</b>. Records could not be fetched.");
		}
	  
		return $record; 
	  }
// returns all the results (not one row)

  public function fetch_all_array($sql) 
	  { 
		$query_id = $this->query($sql); 
		
		$out = array();
			while ($row = $this->fetch_array($query_id)){ 
			$out[] = $row;
		}
	  
		$this->free_result($query_id);
		return $out; 
	  }


  // frees the resultset

  public function free_result($query_id=-1) 
	  { 
		if ($query_id!=-1) {
			$this->query_id=$query_id; 
		}
		if($this->query_id!=0 && !@mysql_free_result($this->query_id)) {
		
			$this->error("Result ID: <b>$this->query_id</b> could not be freed.");
		}
	  }


   // does a query, fetches the first row only, frees resultset
 
  public function query_first($query_string) 
	  {
		  
		$query_id = $this->query($query_string); 
		$out = $this->fetch_array($query_id); 
		$this->free_result($query_id); 
		return $out; 
	  }


  // does an update query with an array
 
  public function query_update($table, $data, $where='1') 
	  { 
		$q="UPDATE `".$this->pre.$table."` SET "; 
	  
		foreach($data as $key=>$val) {
			if(strtolower($val)=='null') $q.= "`$key` = NULL, "; 
																	 
			elseif(strtolower($val)=='now()') $q.= "`$key` = NOW(), ";
			else $q.= "`$key`='".$this->escape($val)."', "; 
		}
	  
		$q = rtrim($q, ', ') . ' WHERE '.$where.';';
	  
		return $this->query($q);
	  }


  public function query_insert($table, $data) 
	  {           
		$q="INSERT INTO `".$this->pre.$table."` ";     
		$v=''; $n='';
	  
		foreach($data as $key=>$val) {
			$n.="`$key`, ";
			if(strtolower($val)=='null') $v.="NULL, ";
			elseif(strtolower($val)=='now()') $v.="NOW(), ";
			else $v.= "'".$this->escape($val)."', ";
		}
	  
		$q .= "(". rtrim($n, ', ') .") VALUES (". rtrim($v, ', ') .");";
	  
		if($this->query($q)){
			return mysql_insert_id();
		}
		else return false;
	  
	  }

// throw an error message

 public function error($msg='')
	 { 
		if($this->link_id>0){
			$this->error=mysql_error($this->link_id); 
			$this->errno=mysql_errno($this->link_id); 
		}
		else{
			$this->error=mysql_error();
			$this->errno=mysql_errno();
		}
		?>
			<table align="center" border="1" cellspacing="0" style="background:white;color:black;width:80%;">
			<tr><th colspan=2>Database Error</th></tr>
			<tr><td align="right" valign="top">Message:</td><td><?php echo $msg; ?></td></tr>
			<?php if(strlen($this->error)>0) {
				echo '<tr><td align="right" valign="top" nowrap>MySQL Error:</td><td>'.$this->error.'</td></tr>'; 
				echo '<tr><td align="right" valign="top" nowrap>MySQL Errno:</td><td>'.$this->errno.'</td></tr>';
				} ?>
			<tr><td align="right">Date:</td><td><?php echo date("l, F j, Y \a\\t g:i:s A"); ?></td></tr>
			<tr><td align="right">Script:</td><td><a href="<?php echo @$_SERVER['REQUEST_URI']; ?>"><?php echo @$_SERVER['REQUEST_URI']; ?></a></td></tr>
			<?php if(strlen(@$_SERVER['HTTP_REFERER'])>0) echo '<tr><td align="right">Referer:</td><td><a href="'.@$_SERVER['HTTP_REFERER'].'">'.@$_SERVER['HTTP_REFERER'].'</a></td></tr>'; ?>
			</table>
		<?php
	  }
	  
	}
?>
