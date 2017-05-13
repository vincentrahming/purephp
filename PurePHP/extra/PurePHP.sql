CREATE TABLE IF NOT EXISTS PasswordArchives (
    RowID               INT(11) NOT NULL AUTO_INCREMENT,
    AccountID           INT(11) NOT NULL,
    AccountPassword     VARCHAR(32),
    PRIMARY KEY (RowID),
    KEY idxAccount ( AccountID, AccountPassword )
)Engine=MyISAM AUTO_INCREMENT=1000001;

CREATE TABLE IF NOT EXISTS Accounts() {    
    AccountID           INT(11) NOT NULL AUTO_INCREMENT,
    AccountFirst        VARCHAR(255) NOT NULL,
    AccountMiddle       VARCHAR(255) NOT NULL,
    AccountLast         VARCHAR(255) NOT NULL,
    AccountDOB          DATE DEFAULT '0000-00-00'
    AccountEmail        VARCHAR(100),
    AccountLogin        VARCHAR(25),
    AccountPassword     VARCHAR(32),
    AccountStreet       TEXT,
    AccountPOBox        VARCHAR(15),
    AccountPhone        VARCHAR(15),
    AccountMobile       VARCHAR(15),    
    AccountSex          ENUM('M','F'),
    AccountPIN          VARCHAR(10),
    AccountResetPIN     VARCHAR(10),
    AccountStatus       ENUM('A','I')
    AccountCreated      DATETIME DEFAULT '0000-00-00 00:00:00',
    AccountModified     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY ( AccountID ),
    KEY idxAccount( AccountFirst(20), AccountLast(20), AccountEmail(50), AccountPhone, AccountMobile )
}Engine=MyISAM AUTO_INCREMENT=1000001;