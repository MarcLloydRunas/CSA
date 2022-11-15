<?php 
require "../src/php/accounts.php";
?>
<div id="login" class="loginForm">
  <div class="text-center">
    <h3>Log In</h3>
  </div>
  <form action="" method="post">
    <div class="mb-3">
      <label for="id_number" class="form-label">ID Number</label>
      <input type="text" name="id_number" class="form-control <?php echo (!empty($login_err)) ? 'is-invalid' : ''; ?>" id="id_number" placeholder="19-0000-000" value="<?php echo $id_number; ?>" required>
      <span class="invalid-feedback"><?php echo $login_err; ?></span>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control <?php echo (!empty($login_err)) ? 'is-invalid' : ''; ?>" id="password" value="<?php echo $password; ?>"required></input>
      <span class="invalid-feedback"><?php echo $login_err; ?></span>
    </div>
    <div class="mb-3">
      <input type="submit" class="btn btn-primary" name="loginUser" id="loginuser" value="Log In">
    </div>
  </form>
</div>

<div style="display: none" class="studentForm div-1">
  <div class="text-center">
    <h3>Student</h3>
  </div>
  <form action="" method="post">
    <div class="mb-3">
      <label for="first_name" class="form-label">First Name</label>
      <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo $first_name; ?>" required>
    </div>
    <div class="mb-3">
      <label for="middle_name" class="form-label">Midlle Name</label>
      <input type="text" name="middle_name" class="form-control" id="middle_name" value="<?php echo $middle_name; ?>" required>
    </div>
    <div class="mb-3">
      <label for="last_name" class="form-label">Last Name</label>
      <input type="text" name="last_name" class="form-control" id="last_name" value="<?php echo $last_name; ?>" required>
    </div>
    <div class="mb-3">
      <label for="suffixes" class="form-label">Suffixes</label>
      <input type="text" name="suffixes" class="form-control" id="suffixes" value="<?php echo $suffixes; ?>">
    </div>
    <div class="mb-3">
      <label for="birth_date" class="form-label">Date of Birth</label>
      <input type="date" name="birth_date" class="form-control" id="birth_date" value="<?php echo $birth_date; ?>" required></input>
    </div>
    <div class="mb-3">
        <label for="sex">Sex</label>
        <select id="sex" name="sex" class="form-control" required>
        <option> </option>    
        <option value="male">male</option>
        <option value="female">female</option>
        </select>
    </div>
    <div class="mb-3">
      <label for="institution_code" class="form-label">Institution Code</label>
      <input type="text" name="institution_code" class="form-control <?php echo (!empty($code_err)) ? 'is-invalid' : ''; ?>" id="institution_code" value="<?php echo $institution_code; ?>" required>
      <span class="invalid-feedback"><?php echo $code_err; ?></span>
    </div>
    <div class="mb-3">
      <label for="student_pass" class="form-label">Password</label>
      <input type="password" name="student_pass" class="form-control <?php echo (!empty($student_pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $student_pass; ?>" required>
      <span class="invalid-feedback"><?php echo $student_pass_err; ?></span>
    </div>
    <div class="mb-3">
      <label for="confirm_student_pass" class="form-label">Confirm Password</label>
      <input type="password" name="confirm_student_pass" class="form-control <?php echo (!empty($confirm_student_pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_student_pass; ?>" required>
      <span class="invalid-feedback"><?php echo $confirm_student_pass_err; ?></span>
    </div>
    <div class="mb-3">
      <input type="submit" class="btn btn-primary" name="studentRegister" id="student_register" value="Proceed">
    </div>
  </form>
</div>

<div style="display: none" class="counselorForm div-1">
  <div class="text-center">
    <h3>Counselor</h3>
  </div>
  <form action="" method="post">
    <div class="mb-3">
      <label for="first_name" class="form-label">First Name</label>
      <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo $first_name; ?>" required>
    </div>
    <div class="mb-3">
      <label for="middle_name" class="form-label">Midlle Name</label>
      <input type="text" name="middle_name" class="form-control" id="middle_name" value="<?php echo $middle_name; ?>" required>
    </div>
    <div class="mb-3">
      <label for="last_name" class="form-label">Last Name</label>
      <input type="text" name="last_name" class="form-control" id="last_name" value="<?php echo $last_name; ?>" required>
    </div>
    <div class="mb-3">
      <label for="suffixes" class="form-label">Suffixes</label>
      <input type="text" name="suffixes" class="form-control" id="suffixes" value="<?php echo $suffixes; ?>">
    </div>
    <div class="mb-3">
      <label for="birth_date" class="form-label">Date of Birth</label>
      <input type="date" name="birth_date" class="form-control" id="birth_date" value="<?php echo $birth_date; ?>" required></input>
    </div>
    <div class="mb-3">
        <label for="sex">Sex</label>
        <select id="sex" name="sex" class="form-control" required>
        <option> </option>    
        <option value="male">male</option>
        <option value="female">female</option>
        </select>
    </div>
    <div class="mb-3">
      <label for="institution_code" class="form-label">Institution Code</label>
      <input type="text" name="institution_code" class="form-control <?php echo (!empty($code_err)) ? 'is-invalid' : ''; ?>" id="institution_code" value="<?php echo $institution_code; ?>" required>
      <span class="invalid-feedback"><?php echo $code_err; ?></span>
    </div>
    <div class="mb-3">
      <label for="counselor_pass" class="form-label">Password</label>
      <input type="password" name="counselor_pass" class="form-control <?php echo (!empty($counselor_pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $counselor_pass; ?>" required>
      <span class="invalid-feedback"><?php echo $counselor_pass_err; ?></span>
    </div>
    <div class="mb-3">
      <label for="confirm_counselor_pass" class="form-label">Confirm Password</label>
      <input type="password" name="confirm_counselor_pass" class="form-control <?php echo (!empty($confirm_counselor_pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_counselor_pass; ?>" required>
      <span class="invalid-feedback"><?php echo $confirm_counselor_pass_err; ?></span>
    </div>
    <div class="mb-3">
      <input type="submit" class="btn btn-primary" name="counselorRegister" id="counselorRegister" value="Proceed">
    </div>
  </form>
</div>

<div style="display: none" class="institutionForm div-1">
  <div class="text-center">
    <h3>Institution</h3>
  </div>
  <form action="" method="post">
    <div class="mb-3">
      <label for="institution_name" class="form-label">Institution Name</label>
      <input type="text" name="institution_name" class="form-control" id="institution_name" value="<?php echo $institution_name; ?>" required>
    </div>
    <div class="mb-3">
      <label for="institution_address" class="form-label">Address</label>
      <input type="text" name="institution_address" class="form-control" id="institution_address" value="<?php echo $institution_address; ?>" required>
    </div>
    <div class="mb-3">
      <label for="institution_pass" class="form-label">Password</label>
      <input type="password" name="institution_pass" class="form-control <?php echo (!empty($institution_pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $institution_pass; ?>" required>
      <span class="invalid-feedback"><?php echo $institution_pass_err; ?></span>
    </div>
    <div class="mb-3">
      <label for="confirm_institution_pass" class="form-label">Confirm Password</label>
      <input type="password" name="confirm_institution_pass" class="form-control <?php echo (!empty($confirm_institution_pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_institution_pass; ?>" required>
      <span class="invalid-feedback"><?php echo $confirm_institution_pass_err; ?></span>
    </div>
    <div class="mb-3">
      <input type="submit" class="btn btn-primary" name="institutionRegister" id="institutionRegister" value="Proceed">
    </div>
  </form>
</div>