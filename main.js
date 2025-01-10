// close forms
const closeBtns = document.querySelectorAll(".close-btn");
closeBtns.forEach((btn) =>
	btn?.addEventListener("click", function (e) {
		btn.closest(".overlay").classList.add("hidden");
	})
);

// open create_project form
const addProjectBtn = document.querySelector(".add-project-btn");
const addProjectForm = document.querySelector(".add-project-form");

addProjectBtn?.addEventListener("click", function (e) {
	addProjectForm.closest(".overlay").classList.remove("hidden");
});

// open create_project form
const addMemberBtn = document.querySelector(".add-member-btn");
const addMemberForm = document.querySelector(".add-member-form");

addMemberBtn?.addEventListener("click", function (e) {
	console.log(addMemberBtn, addMemberForm);
	addMemberForm.closest(".overlay").classList.remove("hidden");
});

// select project
const select = document.querySelector(".select-project");
const selectBtn = document.querySelector(".select-project-btn");
let selectedProjectId = select?.value;
select?.addEventListener("change", function (e) {
	selectedProjectId = select.value;
});

selectBtn?.addEventListener(
	"click",
	() => (window.location.href = `controllers/project/select.php?project_id=${selectedProjectId}`)
);
// open create_task form
const addTasktBtn = document.querySelector(".add-task-btn");
const addTaskForm = document.querySelector(".add-task-form");

addTasktBtn?.addEventListener("click", function (e) {
	addTaskForm.closest(".overlay").classList.remove("hidden");
});

// handle delete task
const deleteTaskBtns = document.querySelectorAll(".delete-task-btn");
deleteTaskBtns?.forEach((btn) =>
	btn?.addEventListener("click", function (e) {
		console.log(btn.closest(".task").id);
		const taskId = btn.closest(".task").id;
		window.location.href = `controllers/task/delete.php?id=${taskId}`;
	})
);

// handle update task
const updateTaskBtns = document.querySelectorAll(".update-task-btn");
const updateTaskForm = document.querySelector(".update-task-form");

const id = updateTaskForm?.querySelector("#id");
const title = updateTaskForm?.querySelector("#title");
const description = updateTaskForm?.querySelector("#description");
const dueDate = updateTaskForm?.querySelector("#due_date");
const status = updateTaskForm?.querySelector("#status");
const category = updateTaskForm?.querySelector("#category");

updateTaskBtns?.forEach((btn) =>
	btn.addEventListener("click", function (e) {
		const taskId = btn.closest(".task").id;
		const task = fetch(`controllers/task/get.php?id=${taskId}`)
			.then((data) => data.json())
			.then((result) => {
				const [task] = result;
				console.log(task);

				id.value = task.id;
				title.value = task.title;
				description.value = task.description;
				dueDate.value = task.due_date;
				status.value = task.status;
				category.value = task.category;
				task.collaborators.forEach((collaboratorId) => {
					checkbox = updateTaskForm.querySelector(`[name="collaborators[]"][value="${collaboratorId}"]`);
					checkbox.checked = true;
				});
				task.tags.forEach((tagId) => {
					checkbox = updateTaskForm.querySelector(`[name="tags[]"][value="${tagId}"]`);
					checkbox.checked = true;
				});
			});

		updateTaskForm.classList.remove("hidden");
	})
);

// handle open project menu options (preview, update, delete):
const openMenuBtns = document.querySelectorAll("#open-menu");

openMenuBtns.forEach((btn) => {
	btn.addEventListener("click", function (event) {
		// Empêcher la propagation de l'événement pour éviter de fermer immédiatement le menu
		event.stopPropagation();

		// Fermer tous les autres menus ouverts
		document.querySelectorAll("[id^='menu-']").forEach((menu) => {
			if (menu !== btn.nextElementSibling) {
				menu.classList.add("hidden");
			}
		});

		// Ouvrir le menu correspondant au bouton cliqué
		const menu = btn.nextElementSibling;
		menu.classList.toggle("hidden");
	});
});

// Fermer le menu lorsque l'utilisateur clique en dehors
document.addEventListener("click", function (event) {
	// Vérifier si le clic a eu lieu en dehors de tous les menus
	const isClickInsideMenu = Array.from(openMenuBtns).some((btn) => {
		const menu = btn.nextElementSibling;
		return menu.contains(event.target) || btn.contains(event.target);
	});

	// Si le clic est en dehors de tous les menus, les fermer
	if (!isClickInsideMenu) {
		document.querySelectorAll("[id^='menu-']").forEach((menu) => {
			menu.classList.add("hidden");
		});
	}
});

// open update_form project
const updateProjectBtns = document.querySelectorAll(".update-project-btn");
const updateProjectForm = document.querySelector(".update-project-form");

updateProjectBtns?.forEach((btn) =>
	btn.addEventListener("click", function (e) {
		const id = btn.closest("tr").id;
		fetch(`/controllers/project/get.php?id=${id}`)
			.then((response) => response.json())
			.then((data) => {
				document.querySelector("#id").value = data.id;
				document.querySelector("#name").value = data.name;
				document.querySelector("#description").value = data.description;
				document.querySelector("#visibility").value = data.visibility;
				document.querySelector("#due_date").value = data.due_date;
				updateProjectForm.closest(".overlay").classList.remove("hidden");
			})
			.catch((error) => console.error(error));
	})
);
