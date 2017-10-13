

@section('contactform')
<form action="/contactform" method="post">
<input type="text" class="form-control" placeholder="Text input">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
 <textarea class="form-control" rows="3"></textarea>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
@show