<?php require "views/components/head.php"; ?>
<?php require "views/components/nav.php"; ?>

<main class="bg-black min-h-screen py-10">
   <div class="container mx-auto p-4">
      <!-- En-tête de la page -->
      <header class="bg-gray-900 shadow-lg rounded-lg p-6 mb-6">
         <h1 class="text-3xl font-bold text-white">Détails du Projet</h1>
      </header>
      <!-- Section du projet -->
      <div class="bg-gray-900 shadow-lg rounded-lg p-6 [&_h3]:underline space-y-6 mb-6">
         <!-- Nom du projet -->
         <h2 class="text-2xl font-semibold text-white mb-4 text-center" id="projectName"><?= $project['name'] ?></h2>

         <!-- Description du projet -->
         <div class="">
            <h3 class="text-lg font-medium text-white mb-1">Description:</h3>
            <p class="text-gray-300 leading-relaxed" id="projectDescription"><?= $project['description'] ?></p>
         </div>


         <!-- Visibilité -->
         <div>
            <h3 class="text-lg font-medium text-white mb-1">Visibilité:</h3>
            <p class="text-gray-300" id="projectVisibility"><?= $project['visibility'] ?></p>
         </div>

         <!-- Date d'échéance -->
         <div>
            <h3 class="text-lg font-medium text-white mb-1">Date d'échéance:</h3>
            <p class="text-gray-300" id="projectDueDate"><?= $project['due_date'] ?></p>
         </div>
      </div>
      <?php if (count($members)) : ?>
         <h2 class="text-3xl font-bold text-white">Project Members:</h2>
         <table class="w-full text-left bg-gray-900 shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-gray-700 text-white font-medium">
               <tr>
                  <th scope="col" class="px-4 py-4">id</th>
                  <th scope="col" class="px-4 py-3">name</th>
                  <th scope="col" class="px-4 py-3">email</th>
                  <th scope="col" class="px-4 py-3">
                     <span class="sr-only">Actions</span>
                  </th>
               </tr>
            </thead>
            <tbody class=" text-gray-300 [&>tr:last-child()]:border-b-0">
               <?php foreach ($members as $member): ?>
                  <tr class="border-b bg-gray-800" id="<?= $member['id'] ?>">
                     <th scope="row" class="px-4 py-3"><?= $member['id'] ?></th>
                     <td class="px-4 py-3"><?= $member['name'] ?></td>
                     <td class="px-4 py-3"><?= $member['email'] ?></td>
                     <td class="px-4 py-3 flex items-center justify-end relative">
                        <a href="?id=<?= $project['id'] ?>&member_id=<?= $member['id'] ?>" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400">
                           <svg class="w-4 h-4 mr-2" viewbox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                              <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z" />
                           </svg>
                           Delete
                        </a>
                     </td>
                  </tr>
               <?php endforeach ?>
            </tbody>
         </table>
      <?php else : ?>
         <h2 class="text-3xl font-bold text-white text-center bg-gray-900 shadow-lg rounded-lg p-6 mb-6">No member found</h2>
      <?php endif ?>
   </div>
</main>
<?php require "views/components/footer.php"; ?>