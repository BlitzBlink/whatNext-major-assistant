-- INSERT Majors


INSERT INTO Major (name, description) VALUES
("Computer Science", "This major aligns with your logical reasoning, problem-solving, and interest in technology."),
("Psychology", "You're empathetic, observant, and deeply interested in understanding human behavior and emotions."),
("Engineering", "You have a knack for understanding how things work and enjoy hands-on problem-solving and creativity."),
("Business", "You have strong leadership and communication skills, with an eye for strategy and organization — making Business a great fit for you."),
("Biomedical Sciences", "Your curiosity about life sciences and passion for hands-on problem solving align well with Biomedical Sciences."),
("Education", "You are empathetic and motivated to help others learn and grow, making Education a natural choice."),
("Economy", "Your analytical mind and interest in market trends and decision-making make Economy an excellent match.");


-- INSERT Traits

INSERT INTO Trait (name) VALUES
("Analytical"),
("Creative"),
("Social"),
("Organized"),
("Hands-on");

-- INSERT MajorTraits !NOT READY YET DON'T ADD UNTILL WE DETERMINE THE WEIGHTS

-- Computer Science 
INSERT INTO MajorTrait (major_id, trait_id, weight) VALUES
(1, 1, 9),  -- Analytical
(1, 2, 4),  -- Creative
(1, 3, 3),  -- Social
(1, 4, 8),  -- Organized
(1, 5, 4);  -- Hands-on

--  Psychology
INSERT INTO MajorTrait (major_id, trait_id, weight) VALUES
(2, 1, 9),  -- Analytical
(2, 2, 4),  -- Creative
(2, 3, 3),  -- Social
(2, 4, 8),  -- Organized
(2, 5, 4);  -- Hands-on

--  Engineering
INSERT INTO MajorTrait (major_id, trait_id, weight) VALUES
(3, 1, 9),  -- Analytical
(3, 2, 4),  -- Creative
(3, 3, 3),  -- Social
(3, 4, 8),  -- Organized
(3, 5, 4);  -- Hands-on

--  Business
INSERT INTO MajorTrait (major_id, trait_id, weight) VALUES
(4, 1, 9),  -- Analytical
(4, 2, 4),  -- Creative
(4, 3, 3),  -- Social
(4, 4, 8),  -- Organized
(4, 5, 4);  -- Hands-on

--  Biomedical Sciences
INSERT INTO MajorTrait (major_id, trait_id, weight) VALUES
(5, 1, 9),  -- Analytical
(5, 2, 4),  -- Creative
(5, 3, 3),  -- Social
(5, 4, 8),  -- Organized
(5, 5, 4);  -- Hands-on

--  Education
INSERT INTO MajorTrait (major_id, trait_id, weight) VALUES
(6, 1, 9),  -- Analytical
(6, 2, 4),  -- Creative
(6, 3, 3),  -- Social
(6, 4, 8),  -- Organized
(6, 5, 4);  -- Hands-on

--  Economy
INSERT INTO MajorTrait (major_id, trait_id, weight) VALUES
(7, 1, 9),  -- Analytical
(7, 2, 4),  -- Creative
(7, 3, 3),  -- Social
(7, 4, 8),  -- Organized
(7, 5, 4);  -- Hands-on
