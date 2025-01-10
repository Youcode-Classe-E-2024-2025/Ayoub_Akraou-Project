<div id="<?= $task['id'] ?>" class="task relative bg-gray-100 text-black hover:scale-105 cursor-pointer transition-all rounded-md px-2 py-2">
   <div class="absolute left-0 top-0 flex gap-1 p-1.5">
      <?php foreach ($task['tags'] as $tag) : ?>
         <span class="text-[8px] px-1 text-white font-medium rounded-full" style="background-color: <?= $tag['color'] ?>;"><?= $tag['name'] ?></span>
      <?php endforeach ?>
   </div>
   <div class="task-header max-w-fit flex items-start gap-3 ml-auto">
      <button class="update-task-btn">
         <i class="edit-icon fa-regular fa-pen-to-square"></i>
      </button>
      <button class="delete-task-btn">
         <i class="delete-icon fa-solid fa-xmark"></i>
      </button>
   </div>
   <h3 class="task-title !leading-none text-base md:text-lg font-semibold mr-auto capitalize"><?= $task['title'] ?></h3>
   <p class="task-description lg:block text-base leading-normal max-h-[calc(1.5*16px*2)] text-nowrap overflow-hidden text-ellipsis">
      <?= $task['description'] ?>
   </p>
   <p class="deadline text-sm font-medium text-gray-50 text-right"><?= $task['due_date'] ?></p>
</div>