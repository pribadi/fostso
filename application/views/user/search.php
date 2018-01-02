<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user"></i> User</a></li>
            </ol>
            <?php if($this->session->flashdata('info')): ?>
                <div class="box-body">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                            <?php echo $this->session->flashdata('info'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">User</h3>
                    <a href="<?php echo site_url('user/create'); ?>" class="btn btn-primary" style="float: right;">Add</a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Full name</th>
                                        <th>Username</th>
                                        <th>Level</th>
                                        <?php if($this->session->userdata('level')=='Admin'): ?>
                                            <th>Action</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $v): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $v['fullname']; ?></td>
                                            <td><?php echo $v['username']; ?></td>
                                            <td><?php echo $v['level']; ?></td>
                                            <?php if($this->session->userdata('level')=='Admin'): ?>
                                                <td>
                                                    <a href="<?php echo site_url('user/read/' . $v['id']); ?>"><i class="fa fa-eye" aria-hidden="true"></i> View</a> |  
                                                    <a href="<?php echo site_url('user/update/' . $v['id']); ?>"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a> |
                                                    <a href="<?php echo site_url('user/delete/' . $v['id']); ?>" onClick="return doconfirm();" style="color: #d9534f;"><i class="fa fa-remove" aria-hidden="true"></i> Delete</a>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>