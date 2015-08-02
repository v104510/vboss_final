INSERT INTO `login` (`USERNAME`, `PASSWORD`, `ROLE`) VALUES
('sridhar', 'vboss1', 'DEV'),
('nishanth', 'vboss2', 'DEV'),
('kiran', 'vboss3', 'DEV'),
('bqa1', 'vboss1', 'BQA'),
('bqa2', 'vboss2', 'BQA'),
('user1', 'vboss1', 'PRD'),
('user2', 'vboss2', 'PRD');

INSERT INTO `entity` (`ENTITY_ID`, `ENTITY_NAME`, `ENT_ATTR1`, `ENT_ATTR2`, `ENT_ATTR3`, `ENT_ATTR4`, `ENT_ATTR5`, `ENT_BILL_CATG`, `ENT_VR_NR`) VALUES
(1, 'TSSPower', 'Service No', NULL, NULL, NULL, NULL, 'MON', NULL),
(2, 'BSNL', 'Domain', NULL, NULL, NULL, NULL, 'MON', NULL),
(3, 'Cafe Coffee', 'City', NULL, NULL, NULL, NULL, 'IMM', NULL);


--
-- Dumping data for table `entity_prod`
--

INSERT INTO `entity_prod` (`ENT_PROD_ID`, `ENT_PROD_NAME`, `ENT_VR_NR`) VALUES
(1, 'BTU Units', 1),
(2, 'Capachino', 1),
(3, 'Burger', 1),
(4, 'Mobile 3G', 1),
(5, 'Plan-180', 1),
(6, 'Combo-500min', 1);

--
-- Dumping data for table `entity_prod_rule`
--

INSERT INTO `entity_prod_rule` (`ENT_RULE_ID`, `ENT_PROD_ID`, `ENTITY_ID`, `ENT_CHG_TYPE`, `ENT_PRORATE`, `ENT_AMT`, `ENT_TX_PER`, `ENT_VR_NR`) VALUES
(1, 1, 1, 'MRC', 0, '1250.50', '10.00', 1),
(2, 2, 3, 'MRC', 1, '45.00', '10.00', 1),
(3, 3, 3, 'MRC', 0, '20.00', '10.00', 1),
(4, 4, 2, 'MRC', 1, '180.00', '10.00', 1),
(5, 5, 2, 'MRC', 0, '99.99', '10.00', 1),
(6, 6, 2, 'MRC', 1, '500.00', '10.00', 1);



INSERT INTO `address_history_tr` (`ADDRESS_ID`, `LINE1`, `LINE2`, `ZIP_CODE`, `STATE`, `COUNTRY`) VALUES
(102, '1-27, Inform Sector', 'Building 43, F-20', '30004', 'TELEGANA', 'INDIA'),
(103, '1-28, Build Sector', 'Building 43, F-20', '30004', 'AP', 'INDIA'),
(104, '1-29, Country Sector', 'Building 43, F-20', '30004', 'BIHAR', 'INDIA'),
(105, '1-22, Google Sector', 'Building 43, F-20', '30004', 'HARYANA', 'INDIA');


INSERT INTO `ent_inst_prod_tr` (`ENT_PROD_INST_ID`, `ENT_INST_ID`, `ENT_PROD_ID`, `ENT_INST_ST_DT`, `ENT_INST_ED_DT`, `ENT_PROD_INS_STS`, `ENT_VR_NR`) VALUES
(NULL, 29, 4, '2015-12-01', '9999-12-30', 3, 1),
(NULL, 30, 4, '2015-12-11', '9999-12-30', 3, 1),
(NULL, 33, 4, '2015-05-01', '9999-12-30', 3, 1),
(NULL, 32, 4, '2015-05-01', '9999-12-30', 3, 1),
(NULL, 32, 5, '2015-05-01', '2016-04-30', 3, 1),
(NULL, 32, 6, '2015-05-01', '9999-12-30', 3, 1),
(NULL, 31, 4, '2016-01-01', '9999-12-30', 3, 1),
(NULL, 27, 1, '2015-05-01', '9999-12-30', 3, 1),
(NULL, 28, 1, '2016-01-01', '9999-12-30', 3, 1),
(NULL, 27, 1, '2015-05-01', '9999-12-30', 3, 1),
(NULL, 28, 1, '2016-01-01', '9999-12-30', 3, 1),
(NULL, 37, 2, '2015-05-01', '9999-12-30', 3, 1),
(NULL, 38, 3, '2016-01-01', '9999-12-30', 3, 1),
(NULL, 37, 2, '2015-05-01', '9999-12-30', 3, 1),
(NULL, 38, 3, '2016-01-01', '9999-12-30', 3, 1);


INSERT INTO `ent_inst_tr` (`ENT_INST_ID`, `ENTITY_ID`, `ENT_INS_NAME`, `ENT_INST_ATTR1`, `ENT_INST_ATTR2`, `ENT_INST_ATTR3`, `ENT_INST_ATTR4`, `ENT_INST_ATTR5`, `ADDRESS_ID`, `ENT_INST_ST_DT`, `ENT_INST_ED_DT`, `ENT_INS_STS`, `ENT_VR_NR`) VALUES
(24, 1, 'Costar Airlines', NULL, NULL, NULL, NULL, NULL, 102, '2015-10-01', '9999-12-30', 3, 1),
(25, 1, 'Jet Airlines', NULL, NULL, NULL, NULL, NULL, 102, '2015-12-11', '9999-12-30', 3, 1),
(26, 1, 'CoffeDay Hyd', NULL, NULL, NULL, NULL, NULL, 103, '2015-12-12', '9999-12-30', 3, 1),
(27, 1, 'BVV School', NULL, NULL, NULL, NULL, NULL, 103, '2015-01-01', '9999-12-30', 3, 1),
(28, 1, 'Call India', NULL, NULL, NULL, NULL, NULL, 104, '2014-12-03', '9999-12-30', 3, 1),
(29, 2, 'Google', NULL, NULL, NULL, NULL, NULL, 102, '2015-10-01', '9999-12-30', 3, 1),
(30, 2, 'Verizon', NULL, NULL, NULL, NULL, NULL, 102, '2015-12-11', '9999-12-30', 3, 1),
(31, 2, 'Panasonica', NULL, NULL, NULL, NULL, NULL, 103, '2015-12-12', '9999-12-30', 3, 1),
(32, 2, 'FullVolume', NULL, NULL, NULL, NULL, NULL, 103, '2015-01-01', '9999-12-30', 3, 1),
(33, 2, 'Colgate', NULL, NULL, NULL, NULL, NULL, 104, '2014-12-03', '9999-12-30', 3, 1),
(34, 3, 'RetCust1', NULL, NULL, NULL, NULL, NULL, 102, '0000-00-00', '9999-12-30', 3, 1),
(35, 3, 'RetCust2', NULL, NULL, NULL, NULL, NULL, 102, '2015-12-11', '9999-12-30', 3, 1),
(36, 3, 'RetCust3', NULL, NULL, NULL, NULL, NULL, 103, '2015-12-12', '9999-12-30', 3, 1),
(37, 3, 'RetCust4', NULL, NULL, NULL, NULL, NULL, 103, '2015-01-01', '9999-12-30', 3, 1),
(38, 3, 'RetCust5', NULL, NULL, NULL, NULL, NULL, 104, '2014-12-03', '9999-12-30', 3, 1);


INSERT INTO `version` (`ENT_VR_NR`, `ENT_VR_CATG`, `ENT_PREV_VR_NR`, `INST_CTG`, `ver_date`) VALUES
(1, 'BL', 0, 'DEV', '2015-02-01');