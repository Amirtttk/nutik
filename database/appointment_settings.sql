-- تنظیمات رزرو نوبت مشاوره
CREATE TABLE IF NOT EXISTS `appointment_settings` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `start_time` TIME NOT NULL DEFAULT '10:00:00',
  `end_time` TIME NOT NULL DEFAULT '13:00:00',
  `slot_duration` INT(11) NOT NULL DEFAULT 30 COMMENT 'فاصله هر نوبت به دقیقه',
  `capacity_per_slot` INT(11) NOT NULL DEFAULT 1 COMMENT 'تعداد مشتری قابل ویزیت در هر نوبت',
  `price` INT(11) NOT NULL DEFAULT 0 COMMENT 'هزینه مشاوره (تومان)',
  `working_days` VARCHAR(50) NOT NULL DEFAULT '0,1,2,3,4' COMMENT '0=شنبه تا 6=جمعه',
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `appointment_settings` (`id`, `start_time`, `end_time`, `slot_duration`, `capacity_per_slot`, `price`, `working_days`, `status`)
SELECT 1, '10:00:00', '13:00:00', 30, 1, 0, '0,1,2,3,4', 1
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `appointment_settings` WHERE `id` = 1);
