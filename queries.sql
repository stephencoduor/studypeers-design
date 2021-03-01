alter table quizz add course_id int null;
alter table quizz add university_id int null;

create table assignment_details
(
    id int auto_increment,
    assignment_id int null,
    name varchar(255) null,
    description text null,
    created_at datetime null,
    updated_at datetime null,
    due_at datetime null,
    course_id int null,
    user_id int null,
    html_url varchar(255) null,
    constraint assignment_details_pk
        primary key (id)
);

