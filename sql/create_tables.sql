CREATE TABLE Player(
  id SERIAL PRIMARY KEY,
  username varchar(50) NOT NULL,
  password varchar(50) NOT NULL,
  owner boolean DEFAULT FALSE
);

CREATE TABLE Game(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  published DATE DEFAULT CURRENT_DATE,
  publisher varchar(50),
  description varchar(10000)
);

CREATE TABLE Strategy(
  id SERIAL PRIMARY KEY,
  player_id INTEGER REFERENCES Player(id),
  game_id INTEGER REFERENCES Game(id),
  name varchar(50) NOT NULL,
  description varchar(10000)
); 

CREATE TABLE Message(
  id SERIAL PRIMARY KEY,
  player_id INTEGER REFERENCES Player(id),
  strategy_id INTEGER REFERENCES Strategy(id),
  description varchar(10000),
  created DATE DEFAULT CURRENT_DATE
);