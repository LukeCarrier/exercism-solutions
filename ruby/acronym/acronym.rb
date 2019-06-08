class Acronym
  RE_FIRST_LETTER_OF_WORD = /\b[[:alpha:]]/
  def self.abbreviate(words)
    words.scan(RE_FIRST_LETTER_OF_WORD).join.upcase
  end
end
