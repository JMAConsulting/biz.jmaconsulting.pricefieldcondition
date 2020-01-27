ALTER TABLE civicrm_price_field_condition DROP INDEX UI_entity_id_entity_table;
ALTER TABLE civicrm_price_field_condition ADD UNIQUE INDEX UI_entity_id_entity_table_condition (`entity_id`, `entity_table`, `condition_entity_id`, `condition_entity_table`);
