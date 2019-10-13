<?php

class School
{
    private $students = [];

    public function add(string $student, int $grade): void
    {
        if (!array_key_exists($grade, $this->students)) {
            $this->students[$grade] = [];
        }
        $this->students[$grade][] = $student;
    }

    public function grade(int $grade): array
    {
        if (!array_key_exists($grade, $this->students)) {
            return [];
        }
        sort($this->students[$grade]);
        return $this->students[$grade];
    }

    public function studentsByGradeAlphabetical(): array
    {
        ksort($this->students);
        $result = [];
        foreach (array_keys($this->students) as $grade) {
            $result[$grade] = $this->grade($grade);
        }
        return $result;
    }
}
