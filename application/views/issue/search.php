<div class="content-wrapper">
    <section class="content-header">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-edit"></i> Checklist</a></li>
                <li class="active">Issue</li>
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
                        <h3 class="box-title">Issue</h3>
                        <a href="<?php echo site_url('issue/create'); ?>" class="btn btn-primary" style="float: right;">Add</a>
                    </div>
                    <?php if($data): ?>
                        <div class="box-body">
                            <h4 align="center">Highlight Issue DC TSO</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTabel" id="" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Issue</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $v): ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo date("d-M-Y", strtotime($v['tanggal'])); ?></td>
                                                <td><?php echo $v['issue']; ?></td>
                                                <td><?php echo $v['status']; ?></td>
                                                <td>
                                                    <a href="<?php echo site_url('issue/update/' . $v['id']); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                                    <a href="<?php echo site_url('issue/delete/' . $v['id']); ?>" onClick="return doconfirm();"><i class="fa fa-remove  " aria-hidden="true" style="color: #d9534f;"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>