-- اضافه کردن فیلد coupon به جدول orders
-- برای ذخیره مبلغ تخفیف کد تخفیف استفاده‌شده در سفارش
ALTER TABLE `orders` ADD COLUMN `coupon` BIGINT NOT NULL DEFAULT 0 AFTER `shipping_cost`;
