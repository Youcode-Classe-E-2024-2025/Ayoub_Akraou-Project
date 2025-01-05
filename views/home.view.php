<?php require "views/components/head.php"; ?>
<?php require "views/components/nav.php"; ?>
<main class="flex-1">
   <header class="controllers">
      <div class="box flex gap-2 items-center mb-2">
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
            <option value="">-- select project --</option>
            <?php foreach ($projects as $project) : ?>
               <option value="<?= $project['id'] ?>"><?= $project['name'] ?></option>
            <?php endforeach ?>
         </select>
      </div>
      <div class="filter-sort-btns flex gap-2 max-w-fit mx-auto mb-4">
         <button type="button" data-priority="high" class="text-xl font-medium px-2 sm:px-4 py-0.5 sm:py-1 rounded-full text-white font-athiti bg-red-500 border-2 border-white border-solid flex-1">
            high
         </button>
         <button type="button" data-priority="medium" class="text-xl font-medium px-2 sm:px-4 py-0.5 sm:py-1 rounded-full text-white font-athiti bg-amber-500 border-2 border-white border-solid flex-1">
            medium
         </button>
         <button type="button" data-priority="low" class="text-xl font-medium px-2 sm:px-4 py-0.5 sm:py-1 rounded-full text-white font-athiti bg-green-500 border-2 border-white border-solid flex-1">
            low
         </button>
         <button type="button" data-priority="all" class="text-xl font-medium px-2 sm:px-4 py-0.5 sm:py-1 rounded-full text-white font-athiti bg-black border-2 border-white border-solid flex-1">
            all
         </button>
      </div>
   </header>
   <section class="columns flex flex-col sm:flex-row gap-4 lg:gap-6 text-white">
      <section class="todo-column relative max-h-[85vh] overflow-y-scroll flex-1 h-fit rounded-lg bg-gray-700 text-white overflow-hidden scroll-hidden">
         <h2 class="text-3xl font-medium bg-gray-700 sticky top-0 left-0 right-0 px-4 py-2">
            To do<span class="todo-number text-2xl font-sans font-normal">(1)</span>
         </h2>

         <div class="todo-tasks flex flex-col gap-2 p-3 pt-0">
            <div id="8" onclick="openTaskDetails(this,event)" class="task bg-red-500 hover:scale-105 cursor-pointer transition-all rounded-md px-2 py-2">
               <div class="task-header max-w-fit flex items-start gap-3 ml-auto">
                  <button class="edit-btn" onclick="openEditForm(event)">
                     <i class="edit-icon fa-regular fa-pen-to-square"></i>
                  </button>
                  <button class="delete-btn" onclick="supprimerTache(event)">
                     <i class="delete-icon fa-solid fa-xmark"></i>
                  </button>
               </div>
               <h3 class="task-title !leading-none text-base md:text-lg font-semibold mr-auto capitalize">Rédiger un rapport</h3>
               <p class="task-description hidden lg:block text-base leading-normal max-h-[calc(1.5*16px*2)] text-nowrap overflow-hidden text-ellipsis">
                  Préparer un rapport détaillé pour la direction, incluant les performances du trimestre, les budgets utilisés, et les progrès des projets. Fournir des recommandations pour les prochaines étapes.
               </p>
               <p class="deadline text-sm font-medium text-gray-50 text-right">2024-11-08 17:00</p>
            </div>
         </div>
      </section>
      <section class="doing-column relative max-h-[85vh] overflow-y-scroll flex-1 h-fit rounded-lg bg-gray-700 text-white overflow-hidden scroll-hidden">
         <h2 class="text-3xl font-medium bg-gray-700 sticky top-0 left-0 right-0 px-4 py-2">
            Doing<span class="doing-number text-2xl font-sans font-normal">(1)</span>
         </h2>
         <div class="doing-tasks flex flex-col gap-2 p-3 pt-0">
            <div id="2" onclick="openTaskDetails(this,event)" class="task bg-amber-500 hover:scale-105 cursor-pointer transition-all rounded-md px-2 py-2">
               <div class="task-header max-w-fit flex items-start gap-3 ml-auto">
                  <button class="edit-btn" onclick="openEditForm(event)">
                     <i class="edit-icon fa-regular fa-pen-to-square"></i>
                  </button>
                  <button class="delete-btn" onclick="supprimerTache(event)">
                     <i class="delete-icon fa-solid fa-xmark"></i>
                  </button>
               </div>
               <h3 class="task-title !leading-none text-base md:text-lg font-semibold mr-auto capitalize">Code review</h3>
               <p class="task-description hidden lg:block text-base leading-normal max-h-[calc(1.5*16px*2)] text-nowrap overflow-hidden text-ellipsis">
                  Vérifier minutieusement le code de la nouvelle fonctionnalité ajoutée pour s'assurer qu'il respecte les standards de qualité et ne comporte pas de bugs potentiels. Ajouter des commentaires constructifs si nécessaire.
               </p>
               <p class="deadline text-sm font-medium text-gray-50 text-right">2024-11-03 14:00</p>
            </div>
         </div>
      </section>
      <section class="done-column relative max-h-[85vh] overflow-y-scroll flex-1 h-fit rounded-lg bg-gray-700 text-white overflow-hidden scroll-hidden">
         <h2 class="text-3xl font-medium bg-gray-700 sticky top-0 left-0 right-0 px-4 py-2">
            Done<span class="done-number text-2xl font-sans font-normal">(1)</span>
         </h2>
         <div class="done-tasks flex flex-col gap-2 p-3 pt-0">
            <div id="7" onclick="openTaskDetails(this,event)" class="task bg-green-500 hover:scale-105 cursor-pointer transition-all rounded-md px-2 py-2">
               <div class="task-header max-w-fit flex items-start gap-3 ml-auto">
                  <button class="edit-btn" onclick="openEditForm(event)">
                     <i class="edit-icon fa-regular fa-pen-to-square"></i>
                  </button>
                  <button class="delete-btn" onclick="supprimerTache(event)">
                     <i class="delete-icon fa-solid fa-xmark"></i>
                  </button>
               </div>
               <h3 class="task-title !leading-none text-base md:text-lg font-semibold mr-auto capitalize">Nettoyage de la base de données</h3>
               <p class="task-description hidden lg:block text-base leading-normal max-h-[calc(1.5*16px*2)] text-nowrap overflow-hidden text-ellipsis">
                  Analyser la base de données pour identifier et supprimer les données obsolètes, tout en vérifiant l'intégrité des données existantes. Assurer la sécurité et la performance de la base de données.
               </p>
               <p class="deadline text-sm font-medium text-gray-50 text-right">2024-10-25 08:30</p>
            </div>
         </div>
      </section>
   </section>
</main>
<?php require "views/components/footer.php"; ?>