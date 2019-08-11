#[derive(Clone, Copy, Debug, PartialEq)]
pub enum Allergen {
    Eggs         = 1 << 0,
    Peanuts      = 1 << 1,
    Shellfish    = 1 << 2,
    Strawberries = 1 << 3,
    Tomatoes     = 1 << 4,
    Chocolate    = 1 << 5,
    Pollen       = 1 << 6,
    Cats         = 1 << 7,
}

impl Allergen {
    pub fn all() -> &'static [Self] {
        &[
            Allergen::Eggs,
            Allergen::Peanuts,
            Allergen::Shellfish,
            Allergen::Strawberries,
            Allergen::Tomatoes,
            Allergen::Chocolate,
            Allergen::Pollen,
            Allergen::Cats,
        ]
    }
}

pub struct Allergies {
    pub score: u32,
}

impl Allergies {
    pub fn new(score: u32) -> Self {
        return Self { score }
    }

    pub fn is_allergic_to(&self, allergen: &Allergen) -> bool {
        self.score & *allergen as u32 > 0
    }

    pub fn allergies(&self) -> Vec<Allergen> {
        Allergen::all().iter().filter(|a| self.is_allergic_to(a)).cloned().collect()
    }
}
