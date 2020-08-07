
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Manage Users</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-home"></i></a></li>
                  
                  <li class="breadcrumb-item active" aria-current="page">Users List</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="<?php echo base_url(); ?>admin/manageUsers" class="btn btn-sm btn-neutral">All</a>
              <a href="<?php echo base_url(); ?>admin/pendingUsers" class="btn btn-sm btn-neutral">Not Verified</a>
            </div>
          </div>
          <?php if($this->session->flashdata('flash_message')) { 
                  echo $this->session->flashdata('flash_message');
                }
          ?>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">

            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Users List</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">S.No.</th>
                    <th scope="col" class="sort" data-sort="budget">Name</th>
                    <th scope="col" class="sort" data-sort="budget">Username</th>
                    <th scope="col" class="sort" data-sort="status">Email</th>
                    <th scope="col">Registered At</th>
                    <th scope="col" class="sort" data-sort="completion">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                  <?php $count = 1; foreach ($result as $key => $value) { 
                  ?>
                    <tr>
                      <th scope="row">
                        <?= $count; ?>
                      </th>
                      <td class="budget">
                        <?php echo $value['first_name'].' '.$value['last_name']; ?>
                      </td>
                      <td>
                        <?= $value['username']; ?>
                      </td>
                      <td>
                        <?= $value['email']; ?>
                      </td>
                      <td>
                        <?php echo date("m/d/y, h:i A",strtotime($value['added_on'])) ?>
                      </td>
                      <td>
                        <span class="badge badge-dot mr-4">
                          <?php if($value['is_disable'] == 1) { ?>
                            <i class="bg-danger"></i>
                              <span class="status">Disabled</span>
                          <?php } else { if($value['is_verified'] == 1) { ?>
                              <i class="bg-success"></i>
                              <span class="status">Verified</span>
                            <?php } else { ?>
                              <i class="bg-warning"></i>
                              <span class="status">Pending</span>
                            <?php } } ?>
                          
                        </span>
                      </td>
                      <td>
                        <?php if($value['is_verified'] == 1) { ?>
                        <a href="<?php echo base_url(); ?>admin/viewVerifiedUser/<?php echo base64_encode($value['id']); ?>" class="btn btn-sm btn-default"> View </a> <?php } else { ?> 
                        <a href="<?php echo base_url(); ?>admin/viewUser/<?php echo base64_encode($value['id']); ?>" class="btn btn-sm btn-default">
                        Verify </a> <?php } ?>
                      </td>
                    </tr>
                  <?php $count++; } ?>
                </tbody>
              </table>
            </div>
            <!-- Card footer -->
            <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
      
      