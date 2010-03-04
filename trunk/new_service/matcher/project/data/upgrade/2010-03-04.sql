
-- 2010-03-04

-- modify weight field from int to decimal as client quired.

ALTER TABLE  `data_model` CHANGE  `weight`  `weight` DECIMAL( 8, 2 ) NOT NULL DEFAULT  '0.00';


