-- Player-taulun testidata
INSERT INTO Player (username, password) VALUES ('Kalle', 'Kalle123');
INSERT INTO Player (username, password) VALUES ('Henri', 'Henri123');
INSERT INTO Player (username, password) VALUES ('example', 'example1');
-- Club taulun testidata
INSERT INTO Club (name, created) VALUES ('KeyboardWarriors', NOW());
INSERT INTO Club (name, created) VALUES ('BasicNerds', '1995-11-11');
-- Game taulun testidata
INSERT INTO Game (name, published,  publisher, description) VALUES ('Ristinolla', '2015-11-11', 'Mark', 'Ristinolla ja kynä');
INSERT INTO Game (name, published,  publisher, description) VALUES ('Agricola', '1997-11-11', 'CMark', 'Lampaat on kivoja');
-- Membership taulun testidata
INSERT INTO Membership (player_id, club_id) VALUES (1,1);
INSERT INTO Membership (player_id, club_id) VALUES (1,2);
INSERT INTO Membership (player_id, club_id) VALUES (2,2);
-- Strategy taulun testidata
INSERT INTO Strategy (player_id, game_id, name, description, published) VALUES (1, 1, 'Lush', 'Lush goes the toilet', '2017-11-11');
INSERT INTO Strategy (player_id, game_id, name, description, published) VALUES (1, 1, 'Bush', 'Bush goes the toilet', '2017-11-11');

