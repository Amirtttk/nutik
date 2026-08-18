-- اضافه کردن ستون tip به جدول products (نکته محصول)
ALTER TABLE `products` ADD COLUMN `tip` VARCHAR(500) NULL DEFAULT NULL;
