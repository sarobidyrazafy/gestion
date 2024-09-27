CREATE DATABASE gestion_analytique;
use gestion_analytique;

CREATE TABLE nature(
    idNature INT PRIMARY KEY ,
    nomination VARCHAR(20)
);
INSERT INTO nature VALUES
    (0,''),
    (1,'Variable'),
    (2,'Fixe');

CREATE TABLE secteur(
    idSecteur INT PRIMARY KEY,
    nomination VARCHAR(100),
    estOperationnel INT /* 0 true ou 1 False */
);

CREATE TABLE rubrique(
    idRubrique INT  PRIMARY KEY,
    nom VARCHAR(100),
    total DECIMAL,
    uniteOeuvre VARCHAR(15),
    idNature INT,
    FOREIGN KEY (idNature) REFERENCES nature(idNature)
);

CREATE TABLE rubriqueSecteur(
    idRubrique INT,
    idSecteur INT,
    pourcentage DECIMAL,
    cout DECIMAL,
    FOREIGN KEY (idRubrique) REFERENCES rubrique(idRubrique),
    FOREIGN KEY (idSecteur) REFERENCES secteur(idSecteur)  
);
CREATE or REPLACE view Vrubrique as 
SELECT r.*,n.nomination as nomNature FROM rubrique r
JOIN nature n On 
n.idNature = r.idNature;

CREATE OR REPLACE view VrubriqueSecteur as 
SELECT r.*,s.*,rs.pourcentage,rs.cout from rubrique r
JOIN rubriqueSecteur rs on rs.idRubrique = r.idRubrique 
JOIN secteur s on s.idSecteur = rs.idSecteur;

select idSecteur, nomination, sum(cout) from VrubriqueSecteur group by idSecteur; 

/*
CREATE OR REPLACE view VTest as 
SELECT r.*,s.*,rs.pourcentage,rs.cout from rubrique r
LEFT JOIN rubriqueSecteur rs on rs.idRubrique = r.idRubrique 
LEFT JOIN secteur s on s.idSecteur = rs.idSecteur;
*/

/*Data test*/
INSERT INTO Rubrique(idRubrique,nom,total,uniteOeuvre,idNature) VALUES
                    (0,'Achat SEMENCES',4321600,'kg',1),
                    (1,'ACHAT ENGRAIS&ASSIMILES',60000000,'kg',1),
                    (2,'ACHAT EMBALLAGE',7796400,'kg',0),
                    (3,'FOURNIT BUR ',2783700,'Cons periodique',2);

                    
INSERT INTO secteur VALUES
            (1,'ADM/DIST',1),
            (2,'Usine',0),
            (3,'Plantation',0);

INSERT INTO Rubrique(idRubrique,nom,total,uniteOeuvre,idNature) VALUES
                    (4,'EAU ET ELECTRICITE',34637200,'kg',1);

INSERT INTO rubriqueSecteur(idRubrique, idSecteur, pourcentage, cout) VALUES
		('0','1','0.00','0.00'),
		('0','2','0.00','0.00'),
		('0','3','100.00','4321600'),
		('1','1','0.00','0.00'),
		('1','2','0.00','0.00'),
		('1','3','100.00','60000000'),
		('2','1','0.00','0.00'),
		('2','2','0.00','0.00'),
		('2','3','0.00','0.00'),
		('3','1','100','2783700'),
		('3','2','0.00','0.00'),
		('3','3','0.00','0.00'),
		('4','1','15','5195580'),
		('4','2','80','27709760'),
		('4','3','5','1731860');

UPDATE Rubrique set total = 5321600 where idRubrique = 1;


SELECT 
    s.nomination AS secteur,
    n.nomination AS nature,
    SUM(rs.cout) AS total_cout
FROM 
    rubriqueSecteur rs
JOIN 
    secteur s ON rs.idSecteur = s.idSecteur
JOIN 
    rubrique r ON rs.idRubrique = r.idRubrique
JOIN 
    nature n ON r.idNature = n.idNature
GROUP BY 
    s.nomination, n.nomination
ORDER BY 
    s.nomination, n.nomination;

                    
                    