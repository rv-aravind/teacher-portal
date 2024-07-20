function enableEdit(id) {
    const row = document.querySelector(`tr[data-id="${id}"]`);
    const nameCell = row.querySelector('.name');
    const subjectCell = row.cells[1];
    const marksCell = row.cells[2];
    const updateButton = row.querySelector('.update-btn');

    nameCell.contentEditable = "true";
    subjectCell.contentEditable = "true";
    marksCell.contentEditable = "true";
    updateButton.style.display = "inline-block";

    nameCell.focus();
}

function updateStudent(id) {
    const row = document.querySelector(`tr[data-id="${id}"]`);
    const name = row.querySelector('.name').innerText;
    const subject = row.cells[1].innerText;
    const marks = row.cells[2].innerText;

    const formData = new FormData();
    formData.append('id', id);
    formData.append('name', name);
    formData.append('subject', subject);
    formData.append('marks', marks);

    fetch('../includes/student.php?action=edit', {
        method: 'POST',
        body: formData
    }).then(response => response.text())
    .then(data => {
        document.getElementById('updateMessage').style.display = 'block';
        setTimeout(() => {
            document.getElementById('updateMessage').style.display = 'none';
        }, 3000);
    });

    row.querySelector('.name').contentEditable = "false";
    row.cells[1].contentEditable = "false";
    row.cells[2].contentEditable = "false";
    row.querySelector('.update-btn').style.display = "none";
}

function deleteStudent(id) {
    if (confirm('Are you sure you want to delete this student?')) {
        window.location.href = `../includes/student.php?action=delete&id=${id}`;
    }
}
