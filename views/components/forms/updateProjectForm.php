<div class="overlay hidden w-screen h-screen fixed top-0 left-0 z-20 bg-black/40 flex items-center justify-center">
   <div class="w-full rounded-xl max-w-sm p-6 bg-white relative">
      <button class="close-btn active:scale-90 absolute top-0 right-0 p-1 text-lg leading-none">
         <i class="fa-solid fa-xmark"></i>
      </button>
      <form method='post' class="update-project-form space-y-3" action="controllers/project/update.php">
         <div class="id">
            <label for="id" class="block text-sm/6 font-medium text-gray-900">id</label>
            <input type="text" placeholder="id" name="id" id="id" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
         </div>
         <div>
            <label for="name" class="block text-sm/6 font-medium text-gray-900">name</label>
            <input type="text" placeholder=" name" name="name" id="name" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
         </div>
         <div>
            <label for="description" class="block text-sm/6 font-medium text-gray-900">description</label>
            <textarea type="text" placeholder=" name" name="description" id="description" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
         </div>
         <div>
            <label for="visibility" class="block text-sm/6 font-medium text-gray-900">visibility</label>
            <select name="visibility" id="visibility" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
               <option value="public" selected>public</option>
               <option value="private">private</option>
            </select>
         </div>
         <div>
            <label for="due_date" class="block text-sm/6 font-medium text-gray-900">due date</label>
            <input type="date" placeholder=" due_date" name="due_date" id="due_date" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
         </div>
         <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-gray-800 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update Project</button>
         </div>
      </form>
   </div>
</div>