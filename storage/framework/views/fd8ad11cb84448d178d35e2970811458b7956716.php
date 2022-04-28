<?php $__env->startSection('page_title', __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular')); ?>

<?php $__env->startSection('css'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header'); ?>
<h1 class="page-title">
    <i class="<?php echo e($dataType->icon); ?>"></i>
    <?php echo e(__('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular')); ?>

</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-content container-fluid">
    <form class="form-edit-add" role="form" action="<?php if(!is_null($dataTypeContent->getKey())): ?><?php echo e(route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey())); ?><?php else: ?><?php echo e(route('voyager.'.$dataType->slug.'.store')); ?><?php endif; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
        <!-- PUT Method if we are editing -->
        <?php if(isset($dataTypeContent->id)): ?>
        <?php echo e(method_field("PUT")); ?>

        <?php endif; ?>
        <?php echo e(csrf_field()); ?>


        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-bordered">
                    
                    <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="name"><?php echo e(__('voyager::generic.name')); ?></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo e(__('voyager::generic.name')); ?>" value="<?php echo e(old('name', $dataTypeContent->name ?? '')); ?>">
                        </div>

                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP" value="<?php echo e(old('nip', $dataTypeContent->nip ?? '')); ?>">
                        </div>

                        <div class="form-group">
                            <label for="phone">No Handphone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="No Handphone" value="<?php echo e(old('phone', $dataTypeContent->phone ?? '')); ?>">
                        </div>


                        <?php
                        $selected_gender = optional($dataTypeContent->gender)->id;
                        $genders = \App\Models\Gender::all();
                        $selected_department = optional($dataTypeContent->departemen)->id;
                        $departments = \App\Models\Department::all();
                        $status = ['Admin','Pegawai'];
                        $selected_status = optional($dataTypeContent)->status;
                        $golongan = \App\Models\GovernmentEmployeeGroup::all();
                        $selected_golongan = optional($dataTypeContent)->government_employee_group_id;
                        ?>

                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select class="form-control select2" id="gender" name="gender_id">
                                <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($gender->id); ?>" <?php echo e(($gender->id == $selected_gender ? 'selected' : '')); ?>><?php echo e($gender->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="department">Bagian</label>
                            <select class="form-control select2" id="department" name="department_id">
                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($department->id); ?>" <?php echo e(($department->id == $selected_department ? 'selected' : '')); ?>><?php echo e($department->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="position">Jabatan</label>
                            <input type="text" class="form-control" id="position" name="position" placeholder="Jabatan" value="<?php echo e(old('position', $dataTypeContent->position ?? '')); ?>">
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control select2" id="status" name="status">
                                <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($stat); ?>" <?php echo e(($stat == $selected_status ? 'selected' : '')); ?>><?php echo e($stat); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        

                        <div class="form-group">
                            <label for="email"><?php echo e(__('voyager::generic.email')); ?></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo e(__('voyager::generic.email')); ?>" value="<?php echo e(old('email', $dataTypeContent->email ?? '')); ?>">
                        </div>

                        <div class="form-group">
                            <label for="password"><?php echo e(__('voyager::generic.password')); ?></label>
                            <?php if(isset($dataTypeContent->password)): ?>
                            <br>
                            <small><?php echo e(__('voyager::profile.password_hint')); ?></small>
                            <?php endif; ?>
                            <input type="password" class="form-control" id="password" name="password" value="" autocomplete="new-password">
                        </div>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('editRoles', $dataTypeContent)): ?>
                        <div class="form-group">
                            <label for="default_role"><?php echo e(__('voyager::profile.role_default')); ?></label>
                            <?php
                            $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};
                            $row = $dataTypeRows->where('field', 'user_belongsto_role_relationship')->first();
                            $options = $row->details;
                            ?>
                            <?php echo $__env->make('voyager::formfields.relationship', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        
                        <?php endif; ?>
                        <?php
                        if (isset($dataTypeContent->locale)) {
                        $selected_locale = $dataTypeContent->locale;
                        } else {
                        $selected_locale = config('app.locale', 'en');
                        }

                        ?>
                        <div class="form-group">
                            <label for="locale"><?php echo e(__('voyager::generic.locale')); ?></label>
                            <select class="form-control select2" id="locale" name="locale">
                                <?php $__currentLoopData = Voyager::getLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($locale); ?>" <?php echo e(($locale == $selected_locale ? 'selected' : '')); ?>><?php echo e($locale); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-bordered panel-warning">
                    <div class="panel-body">
                        <div class="form-group">
                            <?php if(isset($dataTypeContent->avatar)): ?>
                            <img src="<?php echo e(filter_var($dataTypeContent->avatar, FILTER_VALIDATE_URL) ? $dataTypeContent->avatar : Voyager::image( $dataTypeContent->avatar )); ?>" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;" />
                            <?php endif; ?>
                            <input type="file" data-name="avatar" name="avatar">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary pull-right save">
            <?php echo e(__('voyager::generic.save')); ?>

        </button>
    </form>

    <iframe id="form_target" name="form_target" style="display:none"></iframe>
    <form id="my_form" action="<?php echo e(route('voyager.upload')); ?>" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
        <?php echo e(csrf_field()); ?>

        <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
        <input type="hidden" name="type_slug" id="type_slug" value="<?php echo e($dataType->slug); ?>">
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $('document').ready(function() {
        $('.toggleswitch').bootstrapToggle();
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('voyager::master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/apps/spp/resources/views/vendor/voyager/users/edit-add.blade.php ENDPATH**/ ?>