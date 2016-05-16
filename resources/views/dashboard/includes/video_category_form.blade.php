<div class="card-panel hoverable">
  @include('dashboard.includes.error_or_success_message')
  <form class="col s12" method="POST" action="/dashboard/category/create">
   {{ csrf_field() }}
   <div class="row">
     <div class="input-field col s12 m8">
      <input id="name" type="text" class="validate" name="name" value="{{ old('name') }}">
      <label for="name">Name</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12 m8">
      <textarea id="description" class="materialize-textarea" name="description">{{ old('description') }}</textarea>
      <label for="description">Description</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12 m8">
      <button class="btn waves-effect waves-dark" type="submit" name="action"> <i class="material-icons right">send</i>Create
     </button>
   </div>
 </div>
</form>
</div>
