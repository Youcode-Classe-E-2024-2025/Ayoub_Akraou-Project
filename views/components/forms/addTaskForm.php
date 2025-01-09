<div class="add-task-form overlay hidden w-screen h-screen fixed top-0 left-0 z-20 bg-black/40 flex items-center justify-center">
   <div class="w-full rounded-xl max-w-sm p-4 bg-white relative">

      <button class="close-btn active:scale-90 absolute top-0 right-0 p-1 text-lg leading-none">
         <i class="fa-solid fa-xmark"></i>
      </button>

      <form class="space-y-2" action="/controllers/task/add.php" method="post">
         <?= isset($error) ? "<div class='text-red-600 bg-red-200 font-bold'>-- $error --</div>" : '' ?>
         <div class="!mt-0">
            <label for="title" class="block text-sm font-medium text-gray-900">title</label>
            <input type="text" placeholder="title" name="title" id="title" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
         </div>

         <div>
            <label for="description" class="block text-sm font-medium text-gray-900">description</label>
            <input placeholder="description" type="text" name="description" id="description" autocomplete="description" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
         </div>

         <div>
            <label for="due_date" class="block text-sm font-medium text-gray-900">due_date</label>
            <input type="date" name="due_date" id="due_date" required class="flex-[4] block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
         </div>

         <div class="flex gap-2">
            <div class="flex-1">
               <label for="status" class="block text-sm font-medium text-gray-900">status</label>
               <select name="status" id="status" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
                  <option value="todo">Todo</option>
                  <option value="doing">Doing</option>
                  <option value="done">Done</option>
               </select>
            </div>

            <div class="flex-1">
               <label for="category" class="block text-sm font-medium text-gray-900">category</label>
               <select name="category" id="category" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
                  <?php foreach ($categories as $category) : ?>
                     <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                  <?php endforeach ?>
               </select>
            </div>
         </div>
         <?php $users = Task::getUnassignedUsersForTask($selectedProject, $next_task_id); ?>
         <div class="flex gap-2">
            <div class="flex-1">
               <h3 class="block text-sm font-medium text-gray-900">assign to:</h3>
               <?php foreach ($users as $user): ?>
                  <input id="<?= 'user' . $user['id'] ?>" type="checkbox" value="<?= $user['id'] ?>" name="collaborators[]">
                  <label for="<?= 'user' . $user['id'] ?>"><?= $user['name'] ?></label>
                  <br>
               <?php endforeach ?>
            </div>
            <?php $tags = Tag::getTags() ?>
            <div class="flex-1">
               <h3 class="block text-sm font-medium text-gray-900">add tags:</h3>
               <?php foreach ($tags as $tag): ?>
                  <input id="<?= 'tag' . $tag['id'] ?>" type="checkbox" value="<?= $tag['id'] ?>" name="tags[]">
                  <label for="<?= 'tag' . $tag['id'] ?>"><?= $tag['name'] ?></label>
                  <br>
               <?php endforeach ?>
            </div>
         </div>
         <button type="submit" class="flex w-full justify-center rounded-md bg-gray-800 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add task</button>
      </form>
   </div>
</div>