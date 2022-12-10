DROP PROCEDURE IF EXISTS draw_o;
DELIMITER //
CREATE PROCEDURE draw_o (IN n INTEGER)
BEGIN
DECLARE i INTEGER DEFAULT 0;
WHILE i < n DO
  SET i = i + 1;
  IF i = n-(n-1)THEN
    SELECT CONCAT(REPEAT(' ', n), REPEAT('o', n), REPEAT(' ', n)) AS "Result";
  ELSE IF i = n-(n-2)THEN
    SELECT CONCAT(REPEAT(' ', n-(n-1)), REPEAT('o', n), REPEAT(' ', n-(n-1))) AS "Result";
  ELSE
    SELECT CONCAT('*', REPEAT(' ', n-2), '*') AS "Result";
  END IF;
END WHILE;
END//
DELIMITER ;