load data infile 'data/Zone.txt' into table Zone ignore 1 lines;
load data infile 'data/Venue.txt' into table Venue ignore 1 lines;
load data infile 'data/Distance.txt' into table Distance ignore 1 lines;
load data infile 'data/Event.txt' into table Event ignore 1 lines (name, venue, date);
load data infile 'data/Rate.txt' into table Rate ignore 1 lines;
load data infile 'data/Customer.txt' into table Customer ignore 1 lines;
load data infile 'data/Reservation.txt' into table Reservation ignore 1 lines;