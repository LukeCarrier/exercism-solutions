using System;
using System.Collections.Generic;
using System.Linq;

public class GradeSchool
{
    private IList<(string Name, int Grade)> students;

    public GradeSchool()
    {
        students = new List<(string, int)>();
    }

    public void Add(string student, int grade)
    {
        students.Add((student, grade));
    }

    public IEnumerable<string> Roster()
    => students
        .OrderBy(s => s.Grade)
        .ThenBy(s => s.Name)
        .Select(s => s.Name)
        .ToArray();

    public IEnumerable<string> Grade(int grade)
    => students
        .OrderBy(s => s.Name)
        .Where(s => s.Grade == grade)
        .Select(s => s.Name)
        .ToArray();
}