<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" integrity="sha512-DIW4FkYTOxjCqRt7oS9BFO+nVOwDL4bzukDyDtMO7crjUZhwpyrWBFroq+IqRe6VnJkTpRAS6nhDvf0w+wHmxg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{
            padding-right:10%;
            padding-left:10%;
        }
        .body-container{
            padding-top:10px;
        }
    </style>
</head>
<body>

    <?php if($this->session->flashdata("status") == "error"): ?>
    <script>
        iziToast.error({
            title: 'Error:',
            message: '<?= $this->session->flashdata("msg")  ?>'
            position:'topCenter',
            overlay:'true'
        });
    </script>
    <?php elseif($this->session->flashdata("status") == "success"): ?>
    <script>
        iziToast.success({
            title: '',
            message: '<?= $this->session->flashdata("msg")  ?>',
            position:'topCenter',
            overlay:'true'
        });
    </script>
    <?php endif; ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Simple Crud System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Todo</a>
                </li>
                <!-- <li class="nav-item">
                <a class="nav-link" href="#">Todo</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
                </li> -->
            </ul>
            <span class="navbar-text">
                Navbar text with an inline element
            </span>
            </div>
        </div>
    </nav>
    <div class="body-container">
        <div class="col-md-12" align="right" style="padding-bottom:10px;">
            <button class="btn btn-outline-secondary" onclick="openModal(0)">Add New Todo</button>
        </div>
        <div class="card">
            <div class="card-header">   
                Todo
            </div>
            <div class="card-body">

                <!-- <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a> -->
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date_Created</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($todo_list as $list): ?>
                        <tr>
                            <td scope="row"><?= $list['id'] ?></td>
                            <td><?= $list['todo_title'] ?></td>
                            <td><?= $list['todo_description'] ?></td>
                            <td><?= $list['date_created'] ?></td>
                            <td><button class="btn btn-sm btn-primary" onclick="openModal(<?= $list['id'] ?>)">Edit</button><a class="btn btn-sm btn-danger" href="<?= base_url("index.php/Main_Controller/delete/".$list['id']) ?>">Delete</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="todoActionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="<?= base_url("index.php/Main_Controller/submit") ?>" method="post">
            <input type="hidden" name="chosen_id" value="0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="input-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title ..." required>
                    </div>
                    <div class="col-md-12">
                        <label for="" class="input-label">Description</label>
                        <!-- <input type="text" class="form-control" name="description" placeholder="Description ..." required> -->
                        <textarea name="description" class="form-control" id="description" placeholder="Description ..." required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
            </div>
        </div>
    </div>
<script>
function openModal(id){
    $('#todoActionModal input[name=chosen_id]').val(id);
    if(id == "0"){
        $('#todoActionModal .modal-title').text("Create New Todo");
    }
    else{
        $('#todoActionModal .modal-title').text("Edit Todo");
        $.ajax({
           url:'<?= base_url("index.php/Main_Controller/getTodoInfo") ?>',
           method:'post',
           data:{
            id:id
           },
           dataType:'json',
           success:function(data){
            const {todo_title,todo_description} = data;
            $('#todoActionModal input[name=title]').val(todo_title);
            $('#todoActionModal textarea[name=description]').val(todo_description);
           },
           error:function(err){
            console.log(err)
           } 
        })
    }
    $('#todoActionModal').modal("show");
}
</script>
</body>
</html>