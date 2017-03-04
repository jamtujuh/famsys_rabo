-- tambah kolom maksi di import asset detail
alter table import_asset_details add maksi int;
-- update maksi dan depbln asset hasil import
update assets set maksi=60, depbln = amount/60 where depbln=0 and source like 'import%';
update asset_details set maksi=60, depbln = price/60 where depbln=0 and source like 'import%';