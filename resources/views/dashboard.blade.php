<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



   <div class="col-md-6 offset-md-3 mt-5">
     <form accept-charset="UTF-8" action="{{ url('createPost') }}" method="POST" enctype="multipart/form-data" >
        @csrf
       <hr>
       <div class="form-group mt-3">
         <label class="mr-2">Upload your Post:</label>
         <input type="file" name="file">
       </div>
       <hr>
       <div class="form-group">
        <label for="exampleInputName">Content</label>
        <input type="textarea" name="content" class="form-control" id="exampleInputName" placeholder="Please share your thoughts on this post.." required="required">
      </div>
       <button type="submit" class="btn btn-primary">Submit</button>
     </form>
 </div>


</x-app-layout>
