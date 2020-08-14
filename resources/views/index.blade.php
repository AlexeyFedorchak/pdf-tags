<!DOCTYPE html>
<html>
<body>
@if($errors->count())
   @foreach($errors->messages() as $message)
       <div class="alert alert-danger" role="alert" style="background: red">
           {{ $message[0] }}
       </div>
   @endforeach
@endif
<form action="/post" method="post" enctype="multipart/form-data">
    @csrf
    Select image to upload:
    <input type="file" name="pdf" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
