-- Player-taulun testidata
INSERT INTO Player (name, password) VALUES ('Kalle', 'Kalle123');
INSERT INTO Player (name, password) VALUES ('Henri', 'Henri123');
-- Club taulun testidata
INSERT INTO Club (name, created) VALUES ('KeyboardWarriors', NOW());
INSERT INTO Club (name, created) VALUES ('BasicNerds', 1995-12-12);
-- Game taulun testidata
INSERT INTO Game (name, published,  publisher, description) VALUES ('Ristinolla', '2015', 'Mark', 'Ristinolla ja kynä';
INSERT INTO Game
-- Membership taulun testidata
INSERT INTO Membership (player_id, club_id) VALUES (1,1);
INSERT INTO Membership (player_id, club_id) VALUES (1,2);
INSERT INTO Membership (player_id, club_id) VALUES (2,2);
-- Strategy taulun testidata
INSERT INTO Strategy (player_id, game_id, name, description, published) VALUES (1,1, 'Lush', 'Lush goes the toilet', '2017');
INSERT INTO Strategy (player_id, game_id, name, description, published) VALUES (1,1, 'Bush', 'Bush goes the toilet', '2017');

