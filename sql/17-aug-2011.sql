-- table assets
alter table assets add  source varchar(20) default ('purchase');
-- biar field source ga NULL, update ini :
-- UPDATE  assets SET  source = 'purchase';
update assets set source = (select top 1 source from asset_details where asset_id = assets.id )
--ex :	 
--BIN/6PCD001/0002/0811 348 	id
--BIN/6PCD001/0003/0811 349	id
	 
/* UPDATE assets
SET assets.source = (SELECT asset_details.source
     FROM asset_details where asset_details.asset_id=406); */
	 
/*select * from accounts where id=102*/
/* INSERT INTO accounts (id, name, gl, linked_gol,
	debit, credit, account_global_id, account_type_id) 
VALUES ('107', 'Biaya Penyusutan Amortisasi', '4444', '0', 'False', 'False', '0', '1') */
