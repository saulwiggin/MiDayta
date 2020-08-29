SET GLOBAL event_scheduler = ON;
CREATE EVENT delete_incoming_message_data
ON SCHEDULE EVERY 1 DAY
STARTS '2020-08-27 00:00:00'
DO
DELETE FROM Incoming WHERE datetime < NOW() - INTERVAL 1 DAY;
DELETE FROM message_data WHERE datetime < NOW() - INTERVAL 10 DAY