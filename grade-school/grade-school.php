<?php

class School {

    /**
     * @var StudentsCollection
     */
    private $students;

    public function __construct() {
        $this->students = new StudentsCollection();
    }

    public function add(string $name, int $grade) {
        $this->students->add(new Student($name, $grade));
    }

    public function grade(int $grade): array {
        return $this->students->getByGrade($grade);
    }

    public function studentsByGradeAlphabetical(): array {
        return $this->students->jsonSerialize();
    }
}

class Student {

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $grade;

    /**
     * Student constructor.
     * @param string $name
     * @param int $grade
     */
    public function __construct(string $name, int $grade) {
        $this->name = $this->validateName($name);
        $this->grade = $this->validateGrade($grade);
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getGrade(): int {

        return $this->grade;
    }

    /**
     * @param string $name
     * @return string
     */
    private function validateName(string $name): string {
        if (preg_match('/\s/', $name)) {
            throw new InvalidArgumentException(__CLASS__ . ': Multiple names are not allowed.');
        }

        return $name;
    }

    /**
     * @param int $grade
     * @return int
     */
    private function validateGrade(int $grade): int {
        if (0 > $grade || 10 < $grade) {
            throw new InvalidArgumentException(__CLASS__ . ': The grade is not valid.');
        }
        return $grade;
    }

}

class StudentsCollection implements Countable, JsonSerializable , IteratorAggregate {

    /**
     * @var Student[]
     */
    private $students = [];

    /**
     * @param Student $student
     */
    public function add(Student $student) {
        $this->students[] = $student;
    }

    /**
     * @param int $grade
     * @return array
     */
    public function getByGrade(int $grade) {
        $students_name = [];

        foreach ($this->students as $student) {
            if ($grade === $student->getGrade()) {
                $students_name[] = $student->getName();
            }
        }

        sort($students_name);

        return $students_name;
    }

    /**
     * @return int
     */
    public function count() {
        return count($this->students);
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize() {
        $students_serialized = [];
        for ($i = 0; $i < 11; $i++) {
            $students_in_grade = $this->getByGrade($i);
            if (!empty($students_in_grade)){
                $students_serialized[$i] = $students_in_grade;
            }
        }

        return $students_serialized;
    }

    /**
     * @return ArrayIterator|Traversable
     */
    public function getIterator() {
        return new ArrayIterator($this->students);
    }
}