CREATE TABLE IF NOT EXISTS  `User` (
  `UserID` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NULL,
  `Password` VARCHAR(45) NULL,
  PRIMARY KEY (`UserID`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS  `Object` (
  `ObjectID` INT NOT NULL,
  `User_UserID` INT NOT NULL,
  `Height` INT NULL,
  `Weight` INT NULL,
  `PickUpLoc` INT NULL,
  `DropLoc` INT NULL,
  PRIMARY KEY (`ObjectID`),
  INDEX `fk_Object_User_idx` (`User_UserID` ASC) VISIBLE,
  CONSTRAINT `fk_Object_User`
    FOREIGN KEY (`User_UserID`)
    REFERENCES  `User` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS  `Robot` (
  `RobotID` INT NOT NULL,
  `Status` VARCHAR(45) NULL,
  `Battery` INT NULL,
  PRIMARY KEY (`RobotID`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS  `Instruction` (
  `InsID` INT NOT NULL,
  `User_UserID` INT NOT NULL,
  `Robot_RobotID` INT NOT NULL,
  `Instruction` VARCHAR(45) NULL,
  `Status` VARCHAR(45) NULL,
  `Log` VARCHAR(45) NULL,
  PRIMARY KEY (`InsID`),
  INDEX `fk_Instruction_User1_idx` (`User_UserID` ASC) VISIBLE,
  INDEX `fk_Instruction_Robot1_idx` (`Robot_RobotID` ASC) VISIBLE,
  CONSTRAINT `fk_Instruction_User1`
    FOREIGN KEY (`User_UserID`)
    REFERENCES  `User` (`UserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Instruction_Robot1`
    FOREIGN KEY (`Robot_RobotID`)
    REFERENCES  `Robot` (`RobotID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
