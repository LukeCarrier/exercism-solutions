using System;
using System.Collections.Generic;
using System.Linq;

public class GradeSchool
{
    private Dictionary<string, int> students = new Dictionary<string, int>();

    public void Add(string student, int grade)
    {
        students.Add(student, grade);
    }

    public IEnumerable<string> Roster() =>
            from student in students
            orderby student.Value, student.Key
            select student.Key;

    public IEnumerable<string> Grade(int grade) =>
            from student in students
            orderby student.Key
            where student.Value == grade
            select student.Key;
}