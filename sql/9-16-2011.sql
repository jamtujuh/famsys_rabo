alter table journal_transactions add noref varchar(20) null


delete from menus where title = 'Find Asset'

alter table delivery_orders add cancel_by varchar(50) null
alter table delivery_orders add cancel_date datetime null
alter table delivery_orders add cancel_note text null


insert into invoice_statuses(name)
values('processing')
-- default nya 1