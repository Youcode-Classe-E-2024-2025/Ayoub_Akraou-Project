<?php $users = Project::getUsersNotInProject($selectedProject); ?>
<div class="overlay hidden w-screen h-screen fixed top-0 left-0 z-20 bg-black/40 flex items-center justify-center">
    <div class="w-full rounded-xl max-w-sm p-6 bg-white relative">
        <button class="close-btn active:scale-90 absolute top-0 right-0 p-1 text-lg leading-none">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <form method='post' class="add-member-form space-y-3" action="controllers/member/add.php">
            <div>
                <label for="member" class="block text-sm/6 font-medium text-gray-900">choose a member</label>
                <select name="user_id" id="member">
                    <?= count($users) === 0 ? "<option value=''>-- empty --</option>" : "" ?>
                    <?php foreach ($users as $user) : ?>
                        <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-gray-800 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" name="ajouterteam">Add Member</button>
            </div>
        </form>
    </div>
</div>