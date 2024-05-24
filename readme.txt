sql changes 
///////


ALTER TABLE `room_registration` CHANGE `datetime` `datetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `blocks` CHANGE `block_descriptipn` `block_description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;

                                        <option <?= (@$updateData['room_id'] == $row['id']) ? 'selected' : ''; ?> value="<?= isset($_REQUEST['edit']) ? $row['id'] : $updateData['room_id']; ?>" room-fees="<?= $row['room_fee'] ?>"><?= $row['room_no'] ?></option>
