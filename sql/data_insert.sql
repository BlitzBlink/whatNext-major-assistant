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

-- 1. Computer Science (9 + 5 + 1 + 4 + 1 = 20)
INSERT INTO MajorTrait (major_id, trait_id, weight) VALUES
(1, 1, 9),  -- Analytical
(1, 2, 5),  -- Creative
(1, 3, 1),  -- Social
(1, 4, 4),  -- Organized
(1, 5, 1);  -- Hands-on

-- 2. Psychology (4 + 2 + 8 + 5 + 1 = 20)
INSERT INTO MajorTrait (major_id, trait_id, weight) VALUES
(2, 1, 4),  -- Analytical
(2, 2, 2),  -- Creative
(2, 3, 8),  -- Social
(2, 4, 5),  -- Organized
(2, 5, 1);  -- Hands-on

-- 3. Engineering (8 + 1 + 1 + 5 + 5 = 20)
INSERT INTO MajorTrait (major_id, trait_id, weight) VALUES
(3, 1, 8),  -- Analytical
(3, 2, 1),  -- Creative
(3, 3, 1),  -- Social
(3, 4, 5),  -- Organized
(3, 5, 5);  -- Hands-on

-- 4. Business (6 + 4 + 6 + 3 + 1 = 20)
INSERT INTO MajorTrait (major_id, trait_id, weight) VALUES
(4, 1, 6),  -- Analytical
(4, 2, 4),  -- Creative
(4, 3, 6),  -- Social
(4, 4, 3),  -- Organized
(4, 5, 1);  -- Hands-on

-- 5. Biomedical Sciences (7 + 1 + 2 + 6 + 4 = 20)
INSERT INTO MajorTrait (major_id, trait_id, weight) VALUES
(5, 1, 7),  -- Analytical
(5, 2, 1),  -- Creative
(5, 3, 2),  -- Social
(5, 4, 6),  -- Organized
(5, 5, 4);  -- Hands-on

-- 6. Education (3 + 4 + 7 + 4 + 2 = 20)
INSERT INTO MajorTrait (major_id, trait_id, weight) VALUES
(6, 1, 3),  -- Analytical
(6, 2, 4),  -- Creative
(6, 3, 7),  -- Social
(6, 4, 4),  -- Organized
(6, 5, 2);  -- Hands-on

-- 7. Economy (6 + 3 + 2 + 7 + 2 = 20)
INSERT INTO MajorTrait (major_id, trait_id, weight) VALUES
(7, 1, 6),  -- Analytical
(7, 2, 3),  -- Creative
(7, 3, 2),  -- Social
(7, 4, 7),  -- Organized
(7, 5, 2);  -- Hands-on


