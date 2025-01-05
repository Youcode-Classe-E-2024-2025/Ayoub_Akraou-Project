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
select.addEventListener("change", function (e) {
	const selectedProjectId = select.value;

	if (selectedProjectId) {
		window.location.href = `controllers/project/select.php?project_id=${selectedProjectId}`;
	}
});

// open create_task form
const addTasktBtn = document.querySelector(".add-task-btn");
const addTaskForm = document.querySelector(".add-task-form");

addTasktBtn?.addEventListener("click", function (e) {
	addTaskForm.closest(".overlay").classList.remove("hidden");
});
