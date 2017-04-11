CREATE TABLE Player(
  id SERIAL PRIMARY KEY,
  username varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Club(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  created DATE
);

CREATE TABLE Game(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  published DATE,
  publisher varchar(50),
  description varchar(10000)
);

CREATE TABLE Membership(
  id SERIAL PRIMARY KEY,
  player_id INTEGER REFERENCES Player(id),
  club_id INTEGER REFERENCES Club(id)
);

CREATE TABLE Strategy(
  id SERIAL PRIMARY KEY,
  player_id INTEGER REFERENCES Player(id),
  game_id INTEGER REFERENCES Game(id),
  name varchar(50) NOT NULL,
  description varchar(10000)
); 