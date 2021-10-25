<?php

  session_start();

  if ( !isset($_SESSION['tasks']) ) {
      $_SESSION['tasks'] = array();
  }



  if ( isset($_GET['clear']) ) {
    unset($_SESSION['tasks']);
  }



?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciador de Tarefas</title>
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Gerenciador de Tarefas</h1>
    </div>
    <div class="form">
      <form action="task.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="insert" value="insert">
        <label for="task_name">Tarefa:</label>
        <input type="text" name="task_name" placeholder="Nome da Tarefa">
        <label for="task_description">Descrição:</label>
        <input type="text" name="task_description" placeholder="Descrição da Tarefa">
        <label for="task_date">Data</label>
        <input type="date" name="task_date" >
        <label for="task_image">Imagem:</label>
        <input type="file" name="task_image">
        <button type="submit">Cadastrar</button>
      </form>
      <?php
        if ( isset( $_SESSION['message'] ) ) {
          echo "<p style='color: #EF5350';>" . $_SESSION['message'] . "</p>";
          unset( $_SESSION['message'] );
        }
      ?>
    </div>
     <div class="separator">

     </div>
     <div class="list-tasks">
       <?php
       
           if ( isset($_SESSION['tasks']) ) {
                echo "<ul>";

                foreach ( $_SESSION['tasks'] as $key => $task ) {
                  echo "<li>
                             <a href='details.php?key=$key'>" . $task['task_name'] . "</a>
                              <button type='button' class='btn-clear' onclick='deletar$key()'>Remover</button>
                              <script>
                                       function deletar$key(){
                                             if ( confirm('Confirmar remoção?') ) {
                                              window.location = 'http://localhost/task.php?key=$key';
                                            }
                                             return false;
                                       }
                              </script>
                      </li>";
                }

                echo "</ul>";
            }
            
       ?>

     </div>
     <div class="footer">
          <p>Desenvolvido por @js_lauer</p>
     </div>
  </div>

</body>
</html>