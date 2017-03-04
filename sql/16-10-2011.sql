INSERT INTO journal_templates (journal_group_id, asset_category_id, name)
VALUES (18, NULL, 'Other cost')


INSERT INTO journal_groups (name)
VALUES ('Pendapatan')


INSERT INTO accounts (name, gl, linked_gol, debit, credit, account_global_id, account_type_id)
VALUES ('Pendapatan', 4444, 0, 'False', 'True', 0, 19)


INSERT INTO account_types (name, descr)
VALUES ('Pendapatan', '')


INSERT INTO configs (key, value)
VALUES ('warning_depreciation', 'Process Depreciation has been performed in this month')