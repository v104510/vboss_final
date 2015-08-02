-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2015 at 06:17 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vboss`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `executebill`(IN entityid MEDIUMINT, IN BSD VARCHAR(10), IN BED VARCHAR(10), IN VRNO MEDIUMINT)
BEGIN	DECLARE instid MEDIUMINT;		DECLARE bildate DATE;		DECLARE exit_loop BOOLEAN;			DECLARE billget_cus CURSOR for	select distinct e.ent_inst_id  , STR_TO_DATE(BSD,'%Y-%m-%d')		from ent_inst_tr e, ent_inst_prod_tr p	where e.ent_inst_id = p.ent_inst_id	and e.entity_id = entityid		and e.ent_ins_sts = '3'	and p.ent_prod_ins_sts = '3'	and e.ent_inst_st_dt <= STR_TO_DATE(BED,'%Y-%m-%d')	and e.ent_inst_ed_dt >= STR_TO_DATE(BSD,'%Y-%m-%d')	and p.ent_inst_st_dt <= STR_TO_DATE(BED,'%Y-%m-%d')	and p.ent_inst_ed_dt >= STR_TO_DATE(BSD,'%Y-%m-%d');			DECLARE CONTINUE HANDLER FOR NOT FOUND SET exit_loop = TRUE;	OPEN billget_cus;		bilget_loop: LOOP		FETCH billget_cus INTO instid,bildate;							IF exit_loop THEN			CLOSE billget_cus;			LEAVE bilget_loop;		END IF;				INSERT INTO bill_gen (bill_gen_id,ent_inst_id,bill_dt,last_mod,ent_vr_nr)		VALUES (NULL, instid, bildate,SYSDATE(), VRNO); 	END LOOP bilget_loop;		END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `executebilldet`(IN entityid MEDIUMINT, IN BSD VARCHAR(10), IN BED VARCHAR(10), IN VRNO MEDIUMINT)
BEGIN		DECLARE instid MEDIUMINT;		DECLARE prodinstid MEDIUMINT;		DECLARE billgenid MEDIUMINT;		DECLARE psd DATE;		DECLARE ped DATE;			DECLARE bildate DATE;			DECLARE txndate DATE;				DECLARE txnamt DECIMAL(10,2);		DECLARE pfactor DECIMAL(10,2);		DECLARE taxamt DECIMAL(10,2);		DECLARE txnbaseamt DECIMAL(10,2);		DECLARE txper DECIMAL(10,2);		DECLARE txnqty DECIMAL(10,2);			DECLARE exit_loop BOOLEAN;		DECLARE tdesc VARCHAR(30) DEFAULT "";					DECLARE billrun_data CURSOR for		select e.ent_inst_id  , p.ent_prod_inst_id, b.bill_gen_id genid, 			greatest(p.ent_inst_st_dt,STR_TO_DATE(BSD,'%Y-%m-%d')) psd,		least(p.ent_inst_ed_dt,STR_TO_DATE(BED,'%Y-%m-%d')) ped,		STR_TO_DATE(BSD,'%Y-%m-%d') bildate,			pt.ent_prod_name tdesc,		r.ent_amt,r.ent_tx_per,		IF(r.ent_prorate=1,TRUNCATE((DATEDIFF(least(p.ent_inst_ed_dt,STR_TO_DATE(BED,'%Y-%m-%d')),greatest(p.ent_inst_st_dt,STR_TO_DATE(BSD,'%Y-%m-%d'))) /31),2), 1.00)		from ent_inst_tr e, ent_inst_prod_tr p, address_history_tr a, entity_prod_rule r,		entity_prod pt, bill_gen b		where e.ent_inst_id = p.ent_inst_id		and e.entity_id = entityid		and e.address_id = a.address_id		and e.ent_ins_sts = '3'		and p.ent_prod_ins_sts = '3'		and e.ent_inst_st_dt <= STR_TO_DATE(BED,'%Y-%m-%d')		and e.ent_inst_ed_dt >= STR_TO_DATE(BSD,'%Y-%m-%d')		and p.ent_inst_st_dt <= STR_TO_DATE(BED,'%Y-%m-%d')		and p.ent_inst_ed_dt >= STR_TO_DATE(BSD,'%Y-%m-%d')		and p.ent_prod_id = r.ent_prod_id		and e.entity_id = r.entity_id		and p.ent_prod_id = pt.ent_prod_id		and b.ent_inst_id = e.ent_inst_id		and b.bill_dt = STR_TO_DATE(BSD,'%Y-%m-%d')		and b.ent_vr_nr = VRNO;		DECLARE CONTINUE HANDLER FOR NOT FOUND SET exit_loop = TRUE;			OPEN billrun_data;		billrun_loop: LOOP			FETCH billrun_data INTO instid,prodinstid,billgenid,psd,ped,bildate,tdesc,txnbaseamt,txper,pfactor;						IF exit_loop THEN				CLOSE billrun_data;				LEAVE billrun_loop;			END IF;						SET txnamt = txnbaseamt * pfactor;			SET taxamt = txnamt * txper / 100;						INSERT INTO bill_gen_det (txn_id,ent_inst_id,ent_prod_inst_id, bill_gen_id,period_st_dt, period_ed_dt,			txn_dt,tnx_desc,txn_amt,tax_amt,txn_base_amt,txn_qty)			VALUES (NULL, instid,prodinstid, billgenid, bildate, psd,ped, tdesc, txnamt, taxamt, txnbaseamt, NULL); 					END LOOP billrun_loop;			END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `address_history_tr`
--

CREATE TABLE IF NOT EXISTS `address_history_tr` (
  `ADDRESS_ID` int(5) DEFAULT NULL,
  `LINE1` varchar(20) DEFAULT NULL,
  `LINE2` varchar(20) DEFAULT NULL,
  `ZIP_CODE` varchar(10) DEFAULT NULL,
  `STATE` varchar(10) DEFAULT NULL,
  `COUNTRY` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- ------------------------------------------------------

--
-- Table structure for table `tkt_mgmt`
--

CREATE TABLE IF NOT EXISTS `tkt_mgmt` (
  `tkt_id` mediumint(9) NOT NULL,
  `tkt_desc` varchar(255) DEFAULT NULL,
  `tkt_resol_txt` varchar(255) DEFAULT NULL,
  `tkt_usr` varchar(10) DEFAULT NULL,
  `tkt_upd_usr` varchar(10) DEFAULT NULL,
  `tkt_raise_dt` date DEFAULT NULL,
  `tkt_lastupd_dt` date DEFAULT NULL,
  `tkt_vr_nr` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bill_gen`
--

CREATE TABLE IF NOT EXISTS `bill_gen` (
  `BILL_GEN_ID` mediumint(9) NOT NULL,
  `ENT_INST_ID` mediumint(9) DEFAULT NULL,
  `BILL_DT` date DEFAULT NULL,
  `LAST_MOD` date DEFAULT NULL,
  `ENT_VR_NR` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bill_gen_det`
--

CREATE TABLE IF NOT EXISTS `bill_gen_det` (
  `TXN_ID` mediumint(9) NOT NULL,
  `ENT_INST_ID` mediumint(9) DEFAULT NULL,
  `ENT_PROD_INST_ID` mediumint(9) DEFAULT NULL,
  `BILL_GEN_ID` mediumint(9) DEFAULT NULL,
  `TXN_DT` date DEFAULT NULL,
  `PERIOD_ST_DT` date DEFAULT NULL,
  `PERIOD_ED_DT` date DEFAULT NULL,
  `TNX_DESC` varchar(100) DEFAULT NULL,
  `TXN_AMT` decimal(10,2) DEFAULT NULL,
  `TAX_AMT` decimal(10,2) DEFAULT NULL,
  `TXN_BASE_AMT` decimal(10,2) DEFAULT NULL,
  `TXN_QTY` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entity`
--

CREATE TABLE IF NOT EXISTS `entity` (
  `ENTITY_ID` mediumint(9) NOT NULL,
  `ENTITY_NAME` varchar(30) DEFAULT NULL,
  `ENT_ATTR1` varchar(10) DEFAULT NULL,
  `ENT_ATTR2` varchar(10) DEFAULT NULL,
  `ENT_ATTR3` varchar(10) DEFAULT NULL,
  `ENT_ATTR4` varchar(10) DEFAULT NULL,
  `ENT_ATTR5` varchar(10) DEFAULT NULL,
  `ENT_BILL_CATG` varchar(10) DEFAULT NULL,
  `ENT_VR_NR` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entity_attrib_map`
--

CREATE TABLE IF NOT EXISTS `entity_attrib_map` (
  `ENTITY_ID` mediumint(9) DEFAULT NULL,
  `ENT_ATTR1_ID` mediumint(9) DEFAULT NULL,
  `ENT_ATTR2_ID` mediumint(9) DEFAULT NULL,
  `ENT_ATTR3_ID` mediumint(9) DEFAULT NULL,
  `ENT_ATTR4_ID` mediumint(9) DEFAULT NULL,
  `ENT_ATTR5_ID` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entity_prod`
--

CREATE TABLE IF NOT EXISTS `entity_prod` (
  `ENT_PROD_ID` mediumint(9) NOT NULL,
  `ENT_PROD_NAME` varchar(30) DEFAULT NULL,
  `ENT_VR_NR` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `entity_prod_rule`
--

CREATE TABLE IF NOT EXISTS `entity_prod_rule` (
  `ENT_RULE_ID` mediumint(9) NOT NULL,
  `ENT_PROD_ID` mediumint(9) DEFAULT NULL,
  `ENTITY_ID` mediumint(9) DEFAULT NULL,
  `ENT_CHG_TYPE` varchar(4) DEFAULT NULL,
  `ENT_PRORATE` tinyint(4) DEFAULT NULL,
  `ENT_AMT` decimal(10,2) DEFAULT NULL,
  `ENT_TX_PER` decimal(10,2) DEFAULT NULL,
  `ENT_VR_NR` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `ent_inst_prod_tr`
--

CREATE TABLE IF NOT EXISTS `ent_inst_prod_tr` (
  `ENT_PROD_INST_ID` mediumint(9) NOT NULL,
  `ENT_INST_ID` mediumint(9) DEFAULT NULL,
  `ENT_PROD_ID` mediumint(9) DEFAULT NULL,
  `ENT_INST_ST_DT` date DEFAULT NULL,
  `ENT_INST_ED_DT` date DEFAULT NULL,
  `ENT_PROD_INS_STS` int(2) DEFAULT NULL,
  `ENT_VR_NR` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ent_inst_tr`
--

CREATE TABLE IF NOT EXISTS `ent_inst_tr` (
  `ENT_INST_ID` mediumint(9) NOT NULL,
  `ENTITY_ID` mediumint(9) DEFAULT NULL,
  `ENT_INS_NAME` varchar(30) DEFAULT NULL,
  `ENT_INST_ATTR1` varchar(10) DEFAULT NULL,
  `ENT_INST_ATTR2` varchar(10) DEFAULT NULL,
  `ENT_INST_ATTR3` varchar(10) DEFAULT NULL,
  `ENT_INST_ATTR4` varchar(10) DEFAULT NULL,
  `ENT_INST_ATTR5` varchar(10) DEFAULT NULL,
  `ADDRESS_ID` mediumint(9) DEFAULT NULL,
  `ENT_INST_ST_DT` date DEFAULT NULL,
  `ENT_INST_ED_DT` date DEFAULT NULL,
  `ENT_INS_STS` int(2) DEFAULT NULL,
  `ENT_VR_NR` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `USERNAME` varchar(30) DEFAULT NULL,
  `PASSWORD` varchar(30) DEFAULT NULL,
  `ROLE` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reference_code`
--

CREATE TABLE IF NOT EXISTS `reference_code` (
  `REF_TYPE_ID` int(10) DEFAULT NULL,
  `REFERENCE_CODE` int(5) DEFAULT NULL,
  `CODE_LABEL` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ref_mapping`
--

CREATE TABLE IF NOT EXISTS `ref_mapping` (
  `ATTRIB_TYPE` varchar(50) DEFAULT NULL,
  `ATTRIB_NAME` varchar(20) DEFAULT NULL,
  `REF_TYPE_ID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE IF NOT EXISTS `register` (
  `title` varchar(6) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `gen` varchar(30) NOT NULL,
  `id` varchar(50) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `add` varchar(300) NOT NULL,
  `city` varchar(30) NOT NULL,
  `coun` varchar(30) NOT NULL,
  `dob` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `usg_det`
--

CREATE TABLE IF NOT EXISTS `usg_det` (
  `USG_ID` mediumint(9) NOT NULL,
  `ENT_INST_ID` mediumint(9) DEFAULT NULL,
  `ENT_PROD_INST_ID` mediumint(9) DEFAULT NULL,
  `USG_DT` date DEFAULT NULL,
  `USG_DESC` varchar(100) DEFAULT NULL,
  `USG_AMT` decimal(10,2) DEFAULT NULL,
  `USG_QTY` decimal(10,2) DEFAULT NULL,
  `ENT_VR_NR` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

CREATE TABLE IF NOT EXISTS `version` (
  `ENT_VR_NR` mediumint(9) NOT NULL,
  `ENT_VR_CATG` varchar(2) DEFAULT NULL,
  `ENT_PREV_VR_NR` mediumint(9) DEFAULT NULL,
  `INST_CTG` varchar(4) DEFAULT NULL,
  `VER_DATE` DATE DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_gen`
--
ALTER TABLE `bill_gen`
  ADD PRIMARY KEY (`BILL_GEN_ID`);

--
-- Indexes for table `bill_gen_det`
--
ALTER TABLE `bill_gen_det`
  ADD PRIMARY KEY (`TXN_ID`);

--
-- Indexes for table `entity`
--
ALTER TABLE `entity`
  ADD PRIMARY KEY (`ENTITY_ID`);

--
-- Indexes for table `entity_prod`
--
ALTER TABLE `entity_prod`
  ADD PRIMARY KEY (`ENT_PROD_ID`);

--
-- Indexes for table `entity_prod_rule`
--
ALTER TABLE `entity_prod_rule`
  ADD PRIMARY KEY (`ENT_RULE_ID`);

--
-- Indexes for table `ent_inst_prod_tr`
--
ALTER TABLE `ent_inst_prod_tr`
  ADD PRIMARY KEY (`ENT_PROD_INST_ID`);

--
-- Indexes for table `ent_inst_tr`
--
ALTER TABLE `ent_inst_tr`
  ADD PRIMARY KEY (`ENT_INST_ID`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usg_det`
--
ALTER TABLE `usg_det`
  ADD PRIMARY KEY (`USG_ID`);

--
-- Indexes for table `version`
--
ALTER TABLE `version`
  ADD PRIMARY KEY (`ENT_VR_NR`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_gen`
--
ALTER TABLE `bill_gen`
  MODIFY `BILL_GEN_ID` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `bill_gen_det`
--
ALTER TABLE `bill_gen_det`
  MODIFY `TXN_ID` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `entity`
--
ALTER TABLE `entity`
  MODIFY `ENTITY_ID` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `entity_prod`
--
ALTER TABLE `entity_prod`
  MODIFY `ENT_PROD_ID` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `entity_prod_rule`
--
ALTER TABLE `entity_prod_rule`
  MODIFY `ENT_RULE_ID` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ent_inst_prod_tr`
--
ALTER TABLE `ent_inst_prod_tr`
  MODIFY `ENT_PROD_INST_ID` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ent_inst_tr`
--
ALTER TABLE `ent_inst_tr`
  MODIFY `ENT_INST_ID` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `usg_det`
--
ALTER TABLE `usg_det`
  MODIFY `USG_ID` mediumint(9) NOT NULL AUTO_INCREMENT;
  
--
-- AUTO_INCREMENT for table `tkt_mgmt`
--
ALTER TABLE `tkt_mgmt`
  MODIFY `tkt_id` mediumint(9) NOT NULL AUTO_INCREMENT;
  
--
-- AUTO_INCREMENT for table `version`
--
ALTER TABLE `version`
  MODIFY `ENT_VR_NR` mediumint(9) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
