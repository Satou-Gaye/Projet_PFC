@extends('layout')  
@section('content')  
<style>   .uper {     
margin-top: 40px;  
  }  
</style>  
  
<div class="card uper">  
  <div class="card-header">  
    Modifier l'utilisateur 
  </div>  
  
  <div class="card-body">  
  
    @if ($errors->any())  
      <div class="alert alert-danger">  
        <ul>  
            @foreach ($errors->all() as $error)  
              <li>{{ $error }}</li>  
@endforeach  
</ul>  
</div><br />  
@endif  
<form method="post" action="{{ route('clients.update', $client->id ) 
}}">  
<div class="form-group">  
@csrf  
@method('PATCH')  
<label for="npr">Nom  :</label>  
<input type="text" class="form-control" name="name" value="{{  
$client->npr }}"/>  
</div>  
<div class="form-group">  
<label for="adresse">Mot de passe :</label>  
<input type="text" class="form-control" name="password" value="{{  
$client->adresse }}"/>  
</div>  
<div class="form-group">  
<label for="email">Email :</label>  
<input type="text" class="form-control" name="email" value="{{  
$client->email }}"/>  
</div>  
<button type="submit" class="btn btn-primary">Modifier</button>  
</form>  
</div>  
</div>  
@endsection 