SELECT SUM(IF(po.order_status = 1, 1,0)) AS delivered_order,
SUM(IF(po.order_status = 0, 1,0)) AS pending_order,
SUM(IF(po.order_status = 2, 1,0)) AS cancel_order,
SUM(IF(po.order_status = 3, 1,0)) AS skip_order,
SUM(IF(po.payment_status = 0, 1,0)) AS pending_payment,
SUM(IF(po.payment_status = 1, 1,0)) AS delivered_payment,
 po.*,a.asset_name,a.asset_last_name,a.asset_mobile,a.asset_email,a.asset_lat,a.asset_long
FROM `dli_place_order` po
left join dli_asset a on a.asset_mobile=po.asset_mobile	where a.id=11;
