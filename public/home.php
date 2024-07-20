<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

require_once '../includes/student.php';
$students = getAllStudents();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tailwebs</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <!-- CSS Link -->
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="js/script.js"></script>
  </head>
  <body>
  <?php include '../includes/header.php'; ?>
  
  <div id="updateMessage" style="display:none;">
        <p style="color: green;">Data has been updated successfully!</p>
    </div>

    <div class="table_section container-fluid">
        
      <table class="table align-middle">
        <thead>
          <tr>
            <th scope="col">
              <span>Name</span>
            </th>
            <th scope="col">
              <span>Subject</span>
            </th>
            <th class="text-center" scope="col">
              <span>Mark</span>
            </th>
            <th class="text-center" scope="col">
              <span>Action</span>
            </th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($students as $student): ?>
            <tr data-id="<?php echo $student['id']; ?>">
                    <td>
                        <span class="name_circle"><?php echo strtoupper($student['name'][0]); ?></span>
                        <span class="name"><?php echo htmlspecialchars($student['name']); ?></span>
                    </td>
                    <td><?php echo htmlspecialchars($student['subject']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($student['marks']); ?></td>
                    <td class="text-center">
                      <div class="d-flex align-items-center justify-content-center">
                        <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="enableEdit(<?php echo $student['id']; ?>)">Edit</a></li>
                                <li><a class="dropdown-item" href="#" onclick="deleteStudent(<?php echo $student['id']; ?>)">Delete</a></li>
                            </ul>
                        </div>
                        <button class="update-btn" style="display:none;" onclick="updateStudent(<?php echo $student['id']; ?>)">Update</button>
                      </div>
                      </td>
                </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

     

      <a
        href="javascript:void(0)"
        class="table_btn"
        data-bs-toggle="modal"
        data-bs-target="#exampleModal"
        >Add</a
      >
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="modal_form">
              <form method="POST" action="../includes/student.php?action=add">
                <div class="mb-3 modal_form_name">
                  <label for="inputName" class="form-label">Name</label>
                  <input
                    type="text" name="name"
                    class="form-control"
                    id="name"
                    aria-describedby="nameHelp"
                    required>
                  <span class="icons user-icon">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="bi bi-person"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"
                      />
                    </svg>
                  </span>
                </div>
                <div class="mb-3 modal_form_subject">
                  <label for="inputSubject" class="form-label">Subject</label>
                  <input type="text" class="form-control"  id="subject" name="subject" required>
                  <span class="icons subject-icon">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="bi bi-chat-square-text"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"
                      />
                      <path
                        d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"
                      />
                    </svg>
                  </span>
                </div>
                <div class="mb-3 modal_form_mark">
                  <label for="inputMark" class="form-label" >Mark</label>
                  <input type="text" class="form-control" id="marks" name="marks" required />
                  <span class="icons mark-icon">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="bi bi-bookmark"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"
                      />
                    </svg>
                  </span>
                </div>
                <div class="text-center mt-5">
                  <button type="submit" class="btn btn-primary modal_btn" >
                    Add
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
