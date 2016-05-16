<div class="card-panel hoverable">
 @include('dashboard.includes.error_or_success_message')
 <form class="col s12" method="POST" action="/dashboard/video/update/{{ $video->id}}">
  {{ csrf_field() }}
  <div class="row">
    <div class="input-field col s12 m8">
      <select name="category" id="category">
        <option value="" >Video Category</option>
        @foreach($categories as $category)
           @if ($category->id === $video->category_id)
           <option selected value="{{ $category->id }}">{{ $category->name }}</option>
           @else 
           <option value="{{ $category->id }}">{{ $category->name }}</option>
           @endif 
        @endforeach
      </select>
      <label>Video Category</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12 m8">
      <input id="title" type="text" class="validate" name="title" value="{{ ucwords($video->title) }}">
      <label for="name">Title</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12 m8">
    <input id="url" type="text" class="validate" name ="url" value="https://www.youtube.com/watch?v={{ $video->url }}">
      <label for="url">Url</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12 m8">
      <textarea id="description" class="materialize-textarea" name="description">{{ $video->description }}</textarea>
      <label for="description">Description</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12 m8">
      <button class="btn waves-effect waves-dark" type="submit" name="action">Update
       <i class="material-icons right">mode_edit</i>
     </button>
   </div>
 </div>
</form>
</div>