ALTER TABLE
  `students` DROP `stu_email`,
  DROP `stu_password`,
  DROP `stu_cpassword`;

ALTER TABLE
  `employes` DROP `emp_username`;

ALTER TABLE
  `users`
ADD
  `user_image` VARCHAR(255) NULL
AFTER
  `role`;

ALTER TABLE
  `users`
ADD
  `user_image` VARCHAR(255) NULL
AFTER
  `role`;