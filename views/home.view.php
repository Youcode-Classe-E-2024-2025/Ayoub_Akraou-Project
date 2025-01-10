<?php require "views/components/head.php"; ?>
<?php require "views/components/nav.php"; ?>
<main class="flex-1">
   <header class="controllers mb-4">
      <div class="box flex gap-2 items-center mb-2 [&>*]:text-nowrap">
         <button class="add-project-btn capitalize rounded-full px-2 py-0.5 sm:py-1 text-xl text-white border-2 border-white border-solid bg-gradient-to-r from-[#243B55] to-[#141E30] font-medium">
            <i class="add-icon fa-solid fa-plus !font-extralight"></i>
            new project
         </button>
         <button class="add-member-btn capitalize rounded-full px-2 py-0.5 sm:py-1 text-xl text-white border-2 border-white border-solid bg-gradient-to-r from-[#243B55] to-[#141E30] font-medium">
            <i class="add-icon fa-solid fa-plus !font-extralight"></i>
            add member
         </button>
         <button class="add-task-btn capitalize rounded-full px-2 py-0.5 sm:py-1 text-xl text-white border-2 border-white border-solid bg-gradient-to-r from-[#243B55] to-[#141E30] font-medium">
            <i class="add-icon fa-solid fa-plus !font-extralight"></i>
            new task
         </button>
         <select class="select-project capitalize rounded-full py-0.5 sm:py-1 text-xl text-white border-2 border-white border-solid bg-gradient-to-r from-[#243B55] to-[#141E30] font-medium [&>*]:text-black text-center">
            <?php if (count($projects) === 0) echo "<option value=''>-- empty --</option>" ?>
            <?php foreach ($projects as $project) : ?>
               <option value="<?= $project['id'] ?>" <?= $selectedProject == $project['id'] ? 'selected' : '' ?>><?= $project['name'] ?></option>
            <?php endforeach ?>
         </select>
         <button class="select-project-btn capitalize rounded-full px-2 py-0.5 sm:py-1 text-xl text-white border-2 border-white border-solid bg-gradient-to-r from-[#243B55] to-[#141E30] font-medium">select</button>
         <?php if ($progress > 0) require "views/components/progress.php" ?>
      </div>
   </header>
   <section class="columns flex flex-col sm:flex-row gap-4 lg:gap-6 text-white">
      <section class="todo-column relative max-h-[85vh] overflow-y-scroll flex-1 h-fit rounded-lg bg-gray-700 text-white overflow-hidden scroll-hidden">
         <h2 class="text-3xl font-medium bg-gray-700 sticky top-0 left-0 right-0 px-4 py-2">
            To do<span class="todo-number text-2xl font-sans font-normal">(<?= count($tasks_todo) ?>)</span>
         </h2>

         <div class="todo-tasks flex flex-col gap-2 p-3 pt-0">
            <?php foreach ($tasks_todo as $task) : ?>
               <?php require "views/components/task.php" ?>
            <?php endforeach ?>
         </div>
      </section>
      <section class="doing-column relative max-h-[85vh] overflow-y-scroll flex-1 h-fit rounded-lg bg-gray-700 text-white overflow-hidden scroll-hidden">
         <h2 class="text-3xl font-medium bg-gray-700 sticky top-0 left-0 right-0 px-4 py-2">
            Doing<span class="doing-number text-2xl font-sans font-normal">(<?= count($tasks_doing) ?>)</span>
         </h2>
         <div class="doing-tasks flex flex-col gap-2 p-3 pt-0">
            <?php foreach ($tasks_doing as $task) : ?>
               <?php require "views/components/task.php" ?>
            <?php endforeach ?>
         </div>
      </section>
      <section class="done-column relative max-h-[85vh] overflow-y-scroll flex-1 h-fit rounded-lg bg-gray-700 text-white overflow-hidden scroll-hidden">
         <h2 class="text-3xl font-medium bg-gray-700 sticky top-0 left-0 right-0 px-4 py-2">
            Done<span class="done-number text-2xl font-sans font-normal">(<?= count($tasks_done) ?>)</span>
         </h2>
         <div class="done-tasks flex flex-col gap-2 p-3 pt-0">
            <?php foreach ($tasks_done as $task) : ?>
               <?php require "views/components/task.php" ?>
            <?php endforeach ?>
         </div>
      </section>
   </section>
</main>
<?php require "views/components/footer.php"; ?>